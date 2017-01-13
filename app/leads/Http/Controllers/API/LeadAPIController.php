<?php

namespace App\leads\Http\Controllers\API;

use App\leads\Http\Requests\API\CreateLeadAPIRequest;
use App\leads\Http\Requests\API\UpdateLeadAPIRequest;
use App\leads\Models\Lead;
use App\leads\Repositories\LeadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LeadController
 * @package App\leads\Http\Controllers\API
 */

class LeadAPIController extends AppBaseController
{
    /** @var  LeadRepository */
    private $leadRepository;

    public function __construct(LeadRepository $leadRepo)
    {
        $this->leadRepository = $leadRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/leads",
     *      summary="Get a listing of the Leads.",
     *      tags={"Lead"},
     *      description="Get all Leads",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Lead")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->leadRepository->pushCriteria(new RequestCriteria($request));
        $this->leadRepository->pushCriteria(new LimitOffsetCriteria($request));
        $leads = $this->leadRepository->all();

        return $this->sendResponse($leads->toArray(), 'Leads retrieved successfully');
    }

    /**
     * @param CreateLeadAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/leads",
     *      summary="Store a newly created Lead in storage",
     *      tags={"Lead"},
     *      description="Store Lead",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lead that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lead")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Lead"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLeadAPIRequest $request)
    {
        $input = $request->all();

        $leads = $this->leadRepository->create($input);

        return $this->sendResponse($leads->toArray(), 'Lead saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/leads/{id}",
     *      summary="Display the specified Lead",
     *      tags={"Lead"},
     *      description="Get Lead",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lead",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Lead"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Lead $lead */
        $lead = $this->leadRepository->findWithoutFail($id);

        if (empty($lead)) {
            return $this->sendError('Lead not found');
        }

        return $this->sendResponse($lead->toArray(), 'Lead retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLeadAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/leads/{id}",
     *      summary="Update the specified Lead in storage",
     *      tags={"Lead"},
     *      description="Update Lead",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lead",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lead that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lead")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Lead"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLeadAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lead $lead */
        $lead = $this->leadRepository->findWithoutFail($id);

        if (empty($lead)) {
            return $this->sendError('Lead not found');
        }

        $lead = $this->leadRepository->update($input, $id);

        return $this->sendResponse($lead->toArray(), 'Lead updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/leads/{id}",
     *      summary="Remove the specified Lead from storage",
     *      tags={"Lead"},
     *      description="Delete Lead",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lead",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Lead $lead */
        $lead = $this->leadRepository->findWithoutFail($id);

        if (empty($lead)) {
            return $this->sendError('Lead not found');
        }

        $lead->delete();

        return $this->sendResponse($id, 'Lead deleted successfully');
    }
}
