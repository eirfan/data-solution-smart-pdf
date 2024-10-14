@extends("layout")

@section("custom-style")

<style>
    .note-editable {
        color:#333;
        background-color:#fff;
    }
    body{
        background-color:#F8F9FA;
    }
</style>
@endsection

@section("content")
<div class="container" style="height:100%;width:100%;background-color:#F8F9FA">
    <div class="row align-items-center justify-content-center" style="height:100%;width:100%">
        <div class="col">
            <div class="d-flex justify-content-center" style="white-space: pre;">
                <div class="card" style="width:800px">
                    <div class="card-body">
                        <input type="hidden" name="content-hidden" id="content-hidden" value="{{$content}}"/>
                        <div id="summernote"></div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
@endsection


@section("custom-script")

<script>
$(document).ready(function() {

    initSummerNote();
})
function initSummerNote() {
    let content = $("#content-hidden").val()
    $("#summernote").summernote({
        height:300,
        width:800,
        airMode:true,
        code:content,

    });
    $("#summernote").summernote("code",content);
}
</script>

@endsection