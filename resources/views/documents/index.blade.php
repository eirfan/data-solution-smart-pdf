@extends("layout")

@section("custom-style")
<style>
    .drop-zone-div{
        border:2px dashed grey;
        width:35%;
        color:grey
    }
    .drop-zone-div:hover {
        cursor:pointer;
        color:blue;
        border-color:blue;
    }
</style>
@endsection

@section("content")

<div class="row align-items-center" style="height:100%;width:100%">
    <div class="col">
        <div class="d-flex justify-content-center mb-3">
            <h1>Data Solution e-Judgement</h1>
        </div>
        <form method="POST" action="files/upload" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-center mb-2">
                <input type="file" id="fileInput" name="fileInput"  required/>
            </div>
            <div class="d-flex justify-content-center">
                @include("documents.upload")
            </div>
            <button type="submit" style="display:none" id="fileSubmitButton">
            </button>
        </form>
    </div>
</div>
@endsection
@section("custom-script")

<script type="text/javascript">
    let fileInput = document.getElementById("fileInput");
    let button = document.getElementById("fileSubmitButton");
    const ALLOWED_FORMAT = ["text/plain","application/pdf"]
    fileInput.addEventListener('change',function(event) {
        if(event.target.files.length != 1) {
            alert("Please upload only 1 file");
            fileInput.value = "";
            return 1;
        }
        const file = event.target.files[0];
        if(file == null) {
            alert("Please select valid file")
            return 1;
        }
        if(!ALLOWED_FORMAT.includes(file.type)) {
            alert("Invalid format");
            fileInput.value = "";
            return 1;
        }

        button.click();
    })
    function chooseFile() {
        if(fileInput != null) {
            fileInput.click();
        }
    }
</script>
@endsection