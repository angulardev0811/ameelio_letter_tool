@extends('layouts.letters')

@section('content')
<script language="javascript" type="text/javascript">
    function limitText(limitField, limitCount, limitNum) {
        if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
        } else {
            limitCount.value = limitNum - limitField.value.length;
        }
    }
</script>
  <main role="main" class="content ml-sm-auto  px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Compose</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          {{-- <button class="btn btn-sm btn-outline-secondary">Share</button> --}}
          {{-- <button class="btn btn-sm btn-outline-secondary">Export</button> --}}
        </div>
        {{-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar"></span>
          This week
        </button> --}}
      </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">

                            <div class="col-sm-6">
                                <form action="/compose/search" method="POST">
                                    @csrf
                                    <div class="searchbar">
                                        <input type="text" class="form-control" name="filter" required autocomplete="filter" placeholder="Start typing a reipient's name or inmage number">
                                        <button type="submit" class="btn  btn-primary search_icon" id="search_btn"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6"></div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($contacts) > 0)
                            <div class="card-category">Search result</div>
                            <hr>
                            @foreach($contacts as $c)
                            <div class="col-sm-12 row">
                                <div class="col-sm-1">
                                    <img src="/user.jpg" style="border-radius:50%; border: 2px solid white;width:60%;" alt="..">
                                </div>
                                <div class="col-sm-5"><p>{{ $c->first_name }} {{ $c->middle_name }} {{ $c->last_name}}<br>{{ $c->facility_name }}</p></div>
                            </div>
                            <hr>
                            @endforeach
                            {{$contacts->links()}}
                            @else
                            <div class="card-category" style="color: red;">You haven't matched contact.</div>
                            <a class="btn btn-md btn-primary" href="/compose">Try again!</a>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-category">Compose <span style="text-transform: lowercase;">a</span> new letter</h4><hr>
                        <div class="card-chart">
                            <form action="/send" method="POST">
                                @csrf
                                <div class="form-group">
                                    <select class="form-control select1" name="name" required>
                                        <option></option>
                                        @foreach($contacts->all() as $c )
                                        <option >{{$c-> first_name}} {{$c-> middle_name }} {{$c-> last_name}}, {{$c-> facility_name}}, {{$c-> facility_address}}, {{$c-> facility_city}} ,{{$c-> facility_state}},{{$c-> facility_postal}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control select2" name="contact_id" required>
                                        <option></option>
                                        @foreach($contacts->all() as $c )
                                        <option>{{$c-> inmate_number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control select3"  rows="30" name="content" placeholder="Start typing your letter here..." onKeyDown="limitText(this.form.content,this.form.countdown,3000);" onKeyUp="limitText(this.form.content,this.form.countdown,3000);" required></textarea>
                                    <h6 class="card-cartegory" style="float:right; color:#2CA8FF">Characters Left: <input readonly type="text" style="border: none;"name="countdown" size="4" value="3000"></h6>
                                </div>
                                    <i class="fa fa-paperclip m-r-5 f-s-18"></i> Add photo</h5>
                                <div class="card-footer">
                                    <div class="state">
                                        <input type="file" name="file" id="file" accept="image/gif, image/jpeg, image/png" name="image" id="file"  class="inputfile" />
                                        <label for="file">Choose Image</label>
                                        <!-- <input type="file" name="myFile"> -->
                                    </div>
                                    <hr>
                                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Send letter</button>
                                    <button class="btn btn-sm btn-primary">Save Drafts</button>
                                </div>
                            </form>
                            <!-- <a class="btn" href="/review"></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@endsection
