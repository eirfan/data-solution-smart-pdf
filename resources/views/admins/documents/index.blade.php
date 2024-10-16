@extends("layout")

@section("content")
<div class="container" style="height:100%;width:100%">
    <div class="row align-items-center justify-content-center" style="height:100%;width:100%">
        <div class="col mt-4 pt-4">
            @if(isset($files) && count($files)!=0)
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">File</th>
                    <th scope="col">Url</th>
                    <th scope="col">Uploaded Date</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($files as $index => $file)
                    <tr>
                        <th scope="row">{{$index +1}}</th>
                        <td>{{$file->name}}</td>
                        <td>
                            <a href="{{url($file->url)}}">
                                {{url($file->url)}}
                            </a>
                        </td>
                        <td>{{$file->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            @else 
            <h4 class="text-center">
                No files found
            </h4>
            @endif
        </div>    
    </div>    
</div>    

  @endsection