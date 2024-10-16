<div class="alert alert-dismissible fade show " role="alert" style="display:none;position:sticky;top:0px;z-index:20">
    <strong id="title_strong"></strong> :
    <span id="message_span"></span>
</div>
@if(isset($error)) 
<h2>Error</h2>
{{$error}}
@endif

<script type="text/javascript">
    function triggerAlert(alertClass,title,message,) {
        // BOC : Global function to control the alert display and hide
        $(".alert").addClass(alertClass);
        $("#title_strong").text(title);
        $("#message_span").text(message);
        $(".alert").show();
        setTimeout(() => {
            $(".alert").fadeOut();
        }, 3000);
        // EOC
        
    }
</script>