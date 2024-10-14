@extends("layout")

@section("custom-style")
<style>
    .drop-zone-div{
        border:2px dashed grey;
        width:35%;
        color:grey
    }
    .drop-zone-div:hover  {
        cursor:pointer;
        color:blue;
        border-color:blue;
    }
    .drop-zone-div.dragover {
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
    let dropZone = document.getElementById("drop_zone");


    const ALLOWED_FORMAT = ["text/plain","application/pdf"]
    fileInput.addEventListener('change',function(event) {
        if(!checkFileFormat(event.target.files)) {
            return 1;
        }
        button.click();
    })
    dropZone.addEventListener("dragover",(event) => {
        event.preventDefault();
        dropZone.classList.add('dragover');
    });
    dropZone.addEventListener("dragleave",(event) => {
        event.preventDefault();
        dropZone.classList.remove("dragover");
    });
    dropZone.addEventListener("drop",(event) => {
        event.preventDefault();
        dropZone.classList.remove("dragover");
        
        if(!checkFileFormat(event.dataTransfer.files)) {
            return 1;
        }
        let file = event.dataTransfer.files[0];
        let dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
        button.click();
    });



    function chooseFile() {
        if(fileInput != null) {
            fileInput.click();
        }
    }
    function checkFileFormat(files) {
        if(files.length != 1) {
            alert("Please upload only 1 file");
            fileInput.value = "";
            return false;
        }
        const file = files[0];
        if(file == null) {
            alert("Please select valid file")
            return false;
        }
        if(!ALLOWED_FORMAT.includes(file.type)) {
            alert("Invalid format");
            fileInput.value = "";
            return false;
        }
        return true;
    }
  
</script>
@endsection