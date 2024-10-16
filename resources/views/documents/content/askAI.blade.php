<div class="position-absolute" id="askAI_div" style="z-index:10;display:none;">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="AIFormControlTextArea">
                       <strong>
                           Ask AI
                        </strong> 
                    </label>
                    <button class="btn btn-plain" id="close-question-button">
                        Close
                    </button>
                </div>
                <textarea class="form-control" id="prompt-textarea"style="width:500px;height:240px;background-color:#e2e4e6" placeholder="Please type your question">
                </textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-plain" id="clear-question-button">
                    Clear
                </button>
                <button class="btn btn-primary" id="submit_question_button">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>