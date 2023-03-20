<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 mt-5">
            <div class="col-12 " style="height:100%!important">
                <div class="card h-100">
                    <div class="card-header">
                        ChatGPT
                    </div>
                    <div class="card-body d-grid align-items-end px-0 h-100">
                        <div  class="chat-messages px-3 w-100 h-100  overflow-auto " style="height: 500px!important;">
                        <div id="chat-msgs">

                        </div>
                        <div id="loading" class="w-100 d-none justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        </div>
                        <!-- <form class="pt-5 w-100 px-3"> -->
                        <div class="input-group px-3">
                            <input onkeypress="if(event.key == 'Enter') submit()" id="question" type="text" class="form-control" placeholder="Type your question...">
                            <button type="submit" class="btn btn-primary" onclick="submit()">Send</button>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        function getMsg(msg, dir = '') {
            let textClass = '';
            if (dir.length) textClass = 'text-' + dir;
            return `<div class="message">
								<div class="message-content ${textClass} ">
									${msg}
								</div>
							</div>
                            <hr>`;
        }

        function displayLoading(loading){
            const loadingNode = document.getElementById("loading");
            if(loading){
                loadingNode.classList.remove("d-none");
                loadingNode.classList.add("d-flex");
            }
            else{
                loadingNode.classList.add("d-none");
                
            }
        }

        function submit() {
            const qst = document.getElementById('question').value;
            document.getElementById('chat-msgs').innerHTML += getMsg(qst, 'end');
            document.getElementById('question').value = '';
            displayLoading(true)
            console.log(qst);
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                // document.getElementById("demo").innerHTML = this.responseText;
                const resp = JSON.parse(this.responseText);
                document.getElementById('chat-msgs').innerHTML += getMsg(resp.choices[0].text, 'start');
                displayLoading(false)
            }
            xhttp.open("POST", "chatGpt.php?qst=" + qst);
            xhttp.send();
        }

        function loadDoc() {

        }
    </script>
</body>

</html>