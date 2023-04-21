<?php

namespace App\Http\Controllers;

use App\Infrastructure\Controller;
use App\Application\Services\InvoiceService;
use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use LogicException;
use Ramsey\Uuid\Uuid;

class InvoiceController extends Controller
{
    protected $invoiceService;
    private const MESSAGE = "Invalid Request";

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(Request $request)
    {

        try {

            $requestArray = $request->only([
                'id'
            ]);

            Validator::Validate(
                $requestArray,
                [
                    'id' => 'required'
                ]
            );

            return response()->json(['response' => 
                                      $this->invoiceService->getInvoices($requestArray['id'])], Response::HTTP_OK);
        } catch (ValidationException $exception) {
            return response()->json(
                [
                    'response' => self::MESSAGE
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function approve(Request $request)
    {
        try {

            $requestArray = $request->only([
                'id',
                'status',
                'entity'
            ]);

            Validator::Validate(
                $requestArray,
                [
                    'id'     => 'required',
                    'status' => 'required',
                    'entity' => 'required',
                ]
            );

            $approvalDto = $this->getAvallDto($request);

            return $this->invoiceService->approve($approvalDto);
        } catch (ValidationException $exception) {
            return response()->json(
                [
                    'response' => self::MESSAGE
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (LogicException $exception) {
            return response()->json(
                [
                    'response' => $exception->getMessage()
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function reject(Request $request)
    {
        try {
            $requestArray = $request->only([
                'id',
                'status',
                'entity'
            ]);

            Validator::Validate(
                $requestArray,
                [
                    'id'     => 'required',
                    'status' => 'required',
                    'entity' => 'required',
                ]
            );

            $approvalDto = $this->getAvallDto($request);
            return $this->invoiceService->reject($approvalDto);
        } catch (ValidationException $exception) {
            return response()->json(
                [
                    'response' => self::MESSAGE
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (LogicException $exception) {
            return response()->json(
                [
                    'response' => $exception->getMessage()
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    private function getAvallDto($request)
    {
        return new ApprovalDto(
            Uuid::fromString($request->get('id')),
            StatusEnum::tryFrom($request->get('status')),
            $request->get('entity')
        );
    }
}
