<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<h1 id="hello">Hello</h1>
<button onclick="myChangeColor()">Try</button>


<div style="margin-top: 20px">
    <p id="demo">HTML elements and performing some action</p>
</div>
<button id="hide">Hide</button>
<button id="show">Show</button>


<h1 id="demo2">Mouse over me</h1>

<h1 id="mouse">HTML elements and performing some action</h1>


<br>

<div class="box">
    div (parent)
    <p class="first">p (child)
        <span>span 1</span>
    </p>
    <p class="second">p (child)
        <span>span 2</span>
    </p>
</div>

<br>

<input type="text" id="number" value="">
<div id="result">Result Ajax</div>
<button id="ajax">Ajax</button>
<script src="index.js"></script>
<script>
    $(document).ready(function (){
        $('.box').children('p.second').css({"color": "blue", "border": "1px solid blue" })

        $('#ajax').click(function (){
            $.ajax({
                url: "result.php",
                type: "post",
                data:{
                    number: $('#number').val()
                },
                success: function (result){
                    $('#result').append(result)
                }
            })
        })

    })
</script>
</body>
</html>