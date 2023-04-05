<?php

namespace App\Http\Controllers;

use App\Http\Resources\DestinationResource;
use App\Http\Resources\OriginResource;
use App\Http\Resources\TerminalResource;
use App\Models\WeeklyPlan;
use App\Repositories\WeeklyPlanRepositoryInterface;
use Carbon\Traits\Week;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Array_;
use function PHPUnit\Framework\isEmpty;

class TravelController extends Controller
{
    /**
     * @param WeeklyPlanRepositoryInterface $weeklyPlanRepository
     */
    public function __construct(public WeeklyPlanRepositoryInterface $weeklyPlanRepository)
    {

    }

    /** return all origins from weeklyplan
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return OriginResource::collection($this->weeklyPlanRepository->origins());
    }


    public function destination(Request $request)
    {
        return DestinationResource::collection($this->weeklyPlanRepository->destinations($request->city));
    }

    /** show all termianl in one city
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function terminals(Request $request)
    {
        $terminal_in_origin = $this->weeklyPlanRepository->terminals($request->city, false);
        $terminal_in_destination = $this->weeklyPlanRepository->terminals($request->city, true);
        return collect(array_merge($terminal_in_destination->toArray(), $terminal_in_origin->toArray()))->unique();
    }

}
