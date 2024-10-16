@extends("layout")

@section("custom-style")

<style>
    .note-editable {
        color:#333;
        background-color:#fff;
        font-size:18px;
        margin-left:20px;
        margin-right:20px;
    }
  
</style>
@endsection

@section("content")
@include("documents.content.askAI")
@include("documents.content.popupAction")
<div class="container" style="height:100%;width:100%;background-color:#f5f7fa">
    <div class="row align-items-center justify-content-center" style="height:100%;width:100%">
        <div class="col">
            <div class="d-flex justify-content-center" style="white-space: pre;">
                <div class="card shadow-sm my-4" style="width:900px">
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

<script type="text/javascript">
    let actionButtonDiv = document.getElementById("action_button_div");
    let AskAIDiv = document.getElementById("askAI_div");
    let isMouseUp = false;
    let selection = null;
    $(document).ready(function() {
        $("#prompt-textarea").val("");
        // BOC : Initialize the summernote configuration
        initSummerNote();
        // EOC

        // BOC : Check if user click down using touchpad or mouse, make it applicable to all documents
        $(document).on("pointerdown",function(event) {
            isMouseUp = false;
        });
        // EOC
        
        // BOC : Check if user release the touchpad or mouse, applicable only for the content section for summernote
        $(".note-editable").on("pointerup",function(event) {
            actionButtonDiv.style.display ="none";
            AskAIDiv.style.display = "none";
            isMouseUp = true;
            
            selection = window.getSelection();
            let selectedText = selection.toString();
            let range = selection.getRangeAt(0);
            if(selectedText && selectedText!="") {
                rect = range.getBoundingClientRect();;
                actionButtonDiv.style.left = rect.right+window.scrollX+"px";
                actionButtonDiv.style.top = (rect.bottom)+window.scrollY+"px";
                actionButtonDiv.style.display = "block";
            }
        }); 
        // EOC

        $('.note-editable').on("contextmenu",function(event) {
            event.preventDefault();
            actionButtonDiv.style.left = event.clientX + window.scrollX+"px";
            actionButtonDiv.style.top = event.clientY + window.scrollY+"px";
        });
    })
   
    $("#copy_button").on("click",function(event) {
        event.preventDefault();
        let selectedText = selection.toString();
        navigator.clipboard.writeText(selectedText);
        triggerAlert("alert-success","Successful","Text copied to clipboard");
    });

    $("#ask_AI_button").on("click",function(event) {
        event.preventDefault();
        const additionalMarginTop = 30;
        AskAIDiv.style.left = event.clientX + window.scrollX+"px";
        AskAIDiv.style.top = event.clientY + additionalMarginTop + window.scrollY+"px";
        AskAIDiv.style.display = "block";
        
    });

    $("#submit_question_button").on("click",function(event) {
        event.preventDefault();
        let question = $("#prompt-textarea").val();
        $("#prompt-textarea").val("Loading...")
        data = {
            "question":question,
        }
        const ApiEndPoint = '{{ url('api/chatgpt/ask')}}'
        fetch(ApiEndPoint, {
            method: "POST",
            headers:{
                "Content-Type":"application/json",
            },
            body:JSON.stringify(data),
        }).then(response=>{
            return response.json()
        }).then(data => {
            $("#prompt-textarea").val(data.data);
        })
    });

    $("#clear-question-button").on("click",function(event) {
        $("#prompt-textarea").val("");
    })

    $("#close-question-button").on("click",function(event) {
        actionButtonDiv.style.display ="none";
        AskAIDiv.style.display = "none";
    })

    function initSummerNote() {
        let content = $("#content-hidden").val()
        $("#summernote").summernote({
            height:300,
            width:800,
            airMode:true,
            popover:{
                air:[],
            },
            code:content,
           
        });
        $("#summernote").summernote("code",content);
    }



</script>

@endsection