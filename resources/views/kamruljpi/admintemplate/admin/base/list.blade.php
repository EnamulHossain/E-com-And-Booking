@extends('layouts.app')
@section('content')
@include('admintemplate::admin.messages.error')
@include('admintemplate::admin.messages.success')
<div class="content">
  <div class="clearfix"></div>
  <div class="card shadow-sm">
    <div class="card-header">
      <ul class="nav nav-tabs d-flex flex-md-row flex-column-reverse align-items-start card-header-tabs">
        <div class="d-flex flex-row">
          <li class="nav-item">
            <a class="nav-link active" href="{{Route( $listRoute )}}">
              <i class="fa fa-list mr-2"></i>{{__('lang.list')}} {{ __('lang.'.$pageTitle) }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route( $createRoute )}}">
              <i class="fa fa-plus mr-2"></i>{{__('lang.create')}} {{ __('lang.'.$pageTitle)}}
            </a>
          </li>
        </div>
      </ul>
    </div>
    <br>
    
    <div class="card-body">
        <div class="d-flex">
          <div class="input-group">
            <input type="search" class="form-control rounded" id="searchInput" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
          <button type="button" class="btn btn-outline-success" id="searchButton">Search</button>
         </div>
         <div class="input-group ml-4">
          <select class="form-control rounded" id="categorySelect" aria-label="Select Category">
            <option value="">Select Category</option>
            <option value="1">Hair</option>
            <option value="2">Skin</option>
          </select>
          <button type="button" class="btn btn-outline-success" id="categoryfilter">Filter</button>

          <select class="form-control rounded ml-4" id="statusSelect" aria-label="Select Status">
            <option value="">Select Status</option>
            <option value="status1">Active </option>
            <option value="status2">Inactive</option>
          </select>
          <button type="button" class="btn btn-outline-success" id="statusfilter">Filter</button>

        </div>
    </div>

      <script>
        // Get references to the input field and search button
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');

        // Add a click event listener to the search button
        searchButton.addEventListener('click', function () {
            // Get the value from the search input
            const searchValue = searchInput.value.trim();

            // Check if the search value is not empty
            if (searchValue !== '') {
                // Build the URL with the search parameter
                const newUrl = `${window.location.pathname}?name=${encodeURIComponent(searchValue)}`;

                // Redirect the user to the new URL
                window.location.href = newUrl;
            }
        });
      </script>
    
    
      <div id="dataTableBuilder_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-10">
                    @if(isset($extraBtns) && count($extraBtns) > 0)
                    @foreach($extraBtns as $exbtnkey => $exbtnvalue)
                    @if(isset($exbtnvalue['routeName']))
                    <a href="{{ Route($exbtnvalue['routeName']) }}"
                      class="@if(isset($exbtnvalue['class'])) {{ $exbtnvalue['class'] }} @endif btn btn-success">@if(isset($exbtnvalue['title']))
                      {{ $exbtnvalue['title'] }} @else {{ $exbtnvalue['routeName'] }} @endif</a>
                    @endif
                    @endforeach
                    @endif
                  </div>

                  <div class="col-md-2">
                    <div class="text-right">
                      @if(isset($btnLists) && count($btnLists) > 0)
                      @foreach($btnLists as $btnkey => $btnvalue)
                      @if(isset($btnvalue['routeName']))
                      <a href="{{ Route($btnvalue['routeName']) }}"
                        class="@if(isset($btnvalue['class'])) {{ $btnvalue['class'] }} @endif">@if(isset($btnvalue['title']))
                        {{ $btnvalue['title'] }} @else {{ $btnvalue['routeName'] }} @endif</a>
                      @endif
                      @endforeach
                      @endif
                      @if($createBtnShow)
                      <a href="{{Route( $createRoute )}}">{{__('lang.create')}}</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="datatable2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      @if(isset($tableLists) && !empty($tableLists) && count($tableLists) > 0)
                      @foreach($tableLists as $listkey => $listvalue)
                      @if(isset($listvalue['title']))
                      <th>{{ __('lang.'.$listvalue['title']) }}</th>
                      @else
                      <th>
                        {{__('lang.'.$listkey)}}
                      </th>
                      @endif
                      @endforeach
                      <th>{{__('lang.action')}}</th>
                      @else
                      @if(isset($fillableLists))
                      @if($isFillable)
                      <?php 
                        echo "<th>".__('lang.'.$primaryKey)."</th>";
                                    ?>
                      @endif
                      @foreach($fillableLists as $fillableList)
                      <th>{{__('lang.'. $fillableList)}}</th>
                      @endforeach
                      <th>{{__('lang.action')}}</th>
                      @endif
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($details))
                    @php($i = 1)
                    @foreach($details as $key => $value)
                    <tr>
                      @if(isset($tableLists) && !empty($tableLists) && count($tableLists) > 0)
                      @foreach($tableLists as $listkey => $listvalue)
                      <?php
                                        $lkc = explode("!", $listkey);
                                        if(count($lkc) > 1) {
                                          print "<td>{$value->{$lkc[0]}->{$lkc[1]}}</td>";
                                        }else{
                                          ?>
                      <td>{!! $value->$listkey !!}</td>
                      <?php
                                        }
                                        ?>
                      @endforeach
                      <td>
                        @if($editBtnShow)
                        <a href="{{route($editRoute,$value->$primaryKey)}}"
                          class="btn btn-success">{{__('lang.edit')}}</a>
                        @endif
                        @if($deleteBtnShow)
                        <a href="{{route($deleteRoute,$value->$primaryKey)}}" class="btn btn-danger">
                          {{ __('lang.delete') }}
                        </a>
                        @endif
                        @if(isset($perRowbtnLists) && count($perRowbtnLists) > 0)
                        @foreach($perRowbtnLists as $perRowbtnList)
                        @if(isset($perRowbtnList['routeName']))
                        <a href="{{route($perRowbtnList['routeName'],$value->$primaryKey)}}"
                          class="btn @if(isset($perRowbtnList['class'])) {{ $perRowbtnList['class'] }} @else btn-success @endif">
                          @if(isset($perRowbtnList['title']))
                          {{ $perRowbtnList['title'] }}
                          @else
                          {{ $perRowbtnList['routeName'] }}
                          @endif
                        </a>
                        @endif
                        @endforeach
                        @endif
                      </td>
                      @else
                      @if(isset($fillableLists) && !empty($fillableLists) && count($fillableLists) > 0)
                      @if($isFillable)
                      <td>{!! $value->$primaryKey !!}</td>
                      @endif
                      @foreach($fillableLists as $listkey)
                      <td>{!! $value->$listkey !!}</td>
                      @endforeach
                      <td>
                        @if($editBtnShow)
                        <a href="{{route($editRoute,$value->$primaryKey)}}"
                          class="btn btn-success">{{__('lang.edit')}}</a>
                        @endif
                        @if($deleteBtnShow)
                        <a href="{{route($deleteRoute,$value->$primaryKey)}}" class="btn btn-danger">
                          {{ __('lang.delete') }}
                        </a>
                        @endif
                        @if(isset($perRowbtnLists) && count($perRowbtnLists) > 0)
                        @foreach($perRowbtnLists as $perRowbtnList)
                        @if(isset($perRowbtnList['routeName']))
                        <a href="{{route($perRowbtnList['routeName'],$value->$primaryKey)}}"
                          class="btn @if(isset($perRowbtnList['class'])) {{ $perRowbtnList['class'] }} @else btn-success @endif">
                          @if(isset($perRowbtnList['title']))
                          {{ $perRowbtnList['title'] }}
                          @else
                          {{ $perRowbtnList['routeName'] }}
                          @endif
                        </a>
                        @endif
                        @endforeach
                        @endif
                      </td>
                      @endif
                      @endif
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
                </div>
              </div>
              {{ $details->links() }}
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection

@section('script')
@if($dataTable)
<script>
  $(function () {
  	    $('#datatable2').DataTable({
  	      "paging": true,
  	      "lengthChange": false,
  	      "searching": false,
  	      "ordering": true,
  	      "info": true,
  	      "autoWidth": false,
  	    });
  	  });
</script>
@endif
@endsection
