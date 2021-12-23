<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GymStaff\BulkDestroyGymStaff;
use App\Http\Requests\Admin\GymStaff\DestroyGymStaff;
use App\Http\Requests\Admin\GymStaff\IndexGymStaff;
use App\Http\Requests\Admin\GymStaff\StoreGymStaff;
use App\Http\Requests\Admin\GymStaff\UpdateGymStaff;
use App\Models\GymLocation;
use App\Models\GymStaff;
use App\Models\GymStaffType;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GymStaffController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexGymStaff $request
     * @return array|Factory|View
     */
    public function index(IndexGymStaff $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(GymStaff::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'email', 'phone', 'clubready_owner_id', 'event_uuid', 'gym_staff_type_id', 'gym_location_id'],

            // set columns to searchIn
            ['id', 'name', 'email', 'phone', 'clubready_owner_id', 'event_uuid'],

            function($query) use ($request) {
                $query->with(['gymStaffType', 'gymLocation']);

                if($request->has('gymStaffTypes')){
                    $query->whereIn('gym_staff_type_id', $request->get('gymStaffTypes'));
                }

                if($request->has('gymLocations')){
                    $query->whereIn('gym_location_id', $request->get('gymLocations'));
                }
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.gym-staff.index', [
            'data' => $data,
            'gymStaffTypes' => GymStaffType::all(),
            'gymLocations' => GymLocation::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.gym-staff.create');

        return view('admin.gym-staff.create', [
            'gymStaffTypes' => GymStaffType::all(),
            'gymLocations' => GymLocation::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGymStaff $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreGymStaff $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['gym_staff_type_id'] = $request->getGymStaffTypeId();
        $sanitized['gym_location_id'] = $request->getGymLocationId();

        // Store the GymStaff
        $gymStaff = GymStaff::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/gym-staffs'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/gym-staffs');
    }

    /**
     * Display the specified resource.
     *
     * @param GymStaff $gymStaff
     * @throws AuthorizationException
     * @return void
     */
    public function show(GymStaff $gymStaff)
    {
        $this->authorize('admin.gym-staff.show', $gymStaff);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GymStaff $gymStaff
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(GymStaff $gymStaff)
    {
        $this->authorize('admin.gym-staff.edit', $gymStaff);

        $gymStaff->load(['gymStaffType', 'gymLocation']);

        return view('admin.gym-staff.edit', [
            'gymStaff' => $gymStaff,
            'gymStaffTypes' => GymStaffType::all(),
            'gymLocations' => GymLocation::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGymStaff $request
     * @param GymStaff $gymStaff
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateGymStaff $request, GymStaff $gymStaff)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['gym_staff_type_id'] = $request->getGymStaffTypeId();
        $sanitized['gym_location_id'] = $request->getGymLocationId();

        // Update changed values GymStaff
        $gymStaff->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/gym-staffs'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/gym-staffs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyGymStaff $request
     * @param GymStaff $gymStaff
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyGymStaff $request, GymStaff $gymStaff)
    {
        $gymStaff->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyGymStaff $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyGymStaff $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    GymStaff::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
