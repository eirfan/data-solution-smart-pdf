@extends("layout")

@section("custom-style")
<style>
    .drop-zone-div{
        border:2px dashed grey;
        width:55%;
        color:grey;
        padding-top:20px;
        padding-bottom:20px;
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
@include("commons.icon")
<div class="container"  style="height:100%;width:100%">
    <div class="row align-items-center justify-content-center"  style="height:100%;width:100%">
        <div class="col px-0">
            <div class="card py-5 shadow-sm" style="background-color:#f8f9fa ">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-3">
                        <h1>
                            Data Solution
                        </h1>
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
        </div>
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
        // BOC : Only support 10mb file and below
        const MAX_SIZE_FILE = 10 * 1024 * 1024  
        let maxSizeInMb = Math.round(MAX_SIZE_FILE/ 1024);
        maxSizeInMb = parseInt((maxSizeInMb / 1024).toFixed(2));
        // EOC
        if(files.length != 1) {
            triggerAlert("alert-warning","One file limit","You are allowed to upload only one file at a time. Select a single file for upload")
            fileInput.value = "";
            return false;
        }
        const file = files[0];
        if(file == null) {
            alert("Please select valid file")
            return false;
        }
        if(file.size > MAX_SIZE_FILE) {
            triggerAlert("alert-warning","File size exceed "+maxSizeInMb+" MB ","Please select smaller file ");
            fileInput.value = "";
            return false;
        }
        if(!ALLOWED_FORMAT.includes(file.type)) {
            triggerAlert("alert-warning","Invalid format","Please insert PDF or text (.txt) file only");
            fileInput.value = "";
            return false;
        }
        return true;
    }
  
</script>
@endsection