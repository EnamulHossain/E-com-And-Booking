<?php

namespace App\Http\Controllers;

use App\DataTables\RoomDataTable;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Repositories\CustomFieldRepository;
use App\Repositories\HotelRoomRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Prettus\Validator\Exceptions\ValidatorException;

class HotelRoomController extends Controller
{
    private $hotelRoomRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;


    public function __construct(HotelRoomRepository $hotelLevelRepo, CustomFieldRepository $customFieldRepo)
    {
        parent::__construct();
        $this->hotelRoomRepository = $hotelLevelRepo;
        $this->customFieldRepository = $customFieldRepo;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoomDataTable $roomDataTable)
    {
        return $roomDataTable->render('hotel_rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::get()->pluck('name', 'id');
        $hasCustomField = in_array($this->hotelRoomRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelRoomRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('hotel_rooms.create')->with("customFields", isset($html) ? $html : false)->with("hotels", $hotels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         HotelRoom::create([
            'hotel_id' => $request->input('hotel_id'),
            'room_no' => $request->input('room_no'),
            'price' => $request->input('price'),
            // 'description' => $request->input('description'), 
            'available' => $request->input('available'),
            'note' => $request->input('note'), 
        ]);
        //return redirect()->route('hotel_rooms.index')->with('success', 'Room Created Successfully');
        //  return redirect(route('hotel_rooms.index'));
        return redirect()->back()->with('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
