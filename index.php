<?php
// This is NOT approporate security for any of the following: user data. This should only be used
// in situations where no non public user data is involved.
//
// In this case our goal is submiting a timeline post to facebook from a facebook comment feed.
$password = "test";
$passwordFromUser = $_GET['pass'];
$postTarget = $_GET['postTarget'];

if($passwordFromUser === $password) {
    echo "Your in it now baby";

    /* PHP SDK v4.0.0 */
    /* make the API call */
    // $request = new FacebookRequest(
    //   $session,
    //   'POST',
    //   '/{page-id}/feed',
    //   array (
    //     'message' => 'This is a test message',
    //   )
    // );
    // $response = $request->execute();
    // $graphObject = $response->getGraphObject();
    /* handle the result */

}
if($passwordFromUser !== $password) {
    echo "Incorrect Password, please try again, or not.";
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <p>Hello world! This is HTML5 Boilerplate.</p>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        <script src="js/main.js"></script>

        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '1476205995968185',
              status     : true,
              xfbml      : true,
              version    : 'v2.1'
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             // js.src = "//connect.facebook.net/en_US/sdk.js";
             js.src = "//connect.facebook.net/en_US/sdk/debug.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>
        <div id="fb-root"></div>
        <div
          class="fb-like"
          data-share="true"
          data-width="450"
          data-show-faces="true">
        </div>
        <style>
        article {
            background-color: red;
            color: #ffffff;
        }
        </style>

        <script>
        $.getJSON( "https://graph.facebook.com/comments/?ids=https://www.marchofdimes.com/facebook/wpd/partners/index.html")
          .done(function( json ) {
            var commentUsername = "";
            var commentMessage = "";
            // var thecount = json["https://www.marchofdimes.com/facebook/wpd/partners/index.html"].comments.data.length; console.log(thecount);
            var commentsArray = [];
            for (var i = 0; i < json["https://www.marchofdimes.com/facebook/wpd/partners/index.html"].comments.data.length; i++) {
                commentUsername = json["https://www.marchofdimes.com/facebook/wpd/partners/index.html"].comments.data[i].from.name;
                commentMessage = json["https://www.marchofdimes.com/facebook/wpd/partners/index.html"].comments.data[i].message;
                console.log(commentMessage + "<<<MESSAGE<<< >>>USER>>>" + commentUsername);
                $('body').append("<article>" + commentMessage + "</article><br/>Via: "+ commentUsername +"<br/>");


                /* make the API call */
                commentsArray.push(commentMessage);
                commentsArray.push(commentUsername);
            };
            console.log("Now FB API post comment");

            if(FB){
                FB.api('/226195144161554/feed', 'post', { caption: commentMessage, name: "the tile",  description: "a neat message", link : "http://www.stackoverflow.com" }, function(response) {});
                // FB.api('/226195144161554', function(response) {
                  // console.log(response.error + "hi?");
                // });
            }

            // FB.login(function(){}, {scope: 'publish_actions'});
            // FB.login(function(){
            //  FB.api('/me/feed', 'post', {message: 'Hello, world!'});
            // }, {scope: 'publish_actions'});
            // if(FB){
            //     FB.api(
            //         "/226195144161554/feed",
            //         "POST",
            //         {
            //             "message": "This is a test message"
            //         },
            //         function (response) {
            //           if (response && !response.error) {
            //             /* handle the result */
            //             // console.log("something went wrong" + response.error + response );
            //           }
            //         }
            //     );
            // }



          })
          .fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        });

//         $.get('https://graph.facebook.com/comments/?ids=https://www.marchofdimes.com/facebook/wpd/partners/index.html', function (data) {
//             // console.log("DATA DUMP >>>>");
//             // console.log($(data).find("data"));
//             // console.log("<<<< DATA DUMP");
//             // var obj = jQuery.parseJSON( data );
//             // console.log( obj.name === "John" );
//             $(data).find("data").each(function () { // or "item" or whatever suits your feed
//                 var el = $(this);
// 				console.log(el);
// //                console.log("------------------------");
//                 console.log("message      : " + el.find("message").text());
// //                console.log("author     : " + el.find("author").text());
// //                console.log("description: " + el.find("description").text());
//             });
//         });
// //        var xhr = new XMLHttpRequest();
// //        xhr.onreadystatechange = function () {
// //			if(xhr.readystate == 4){
// //				console.log(xhr.responseText);
// //			}
// //        }
// //        xhr.open('GET', 'https://graph.facebook.com/comments/?ids=https://www.marchofdimes.com/facebook/wpd/partners/index.html');
// //        xhr.send();

//         $.get('https://graph.facebook.com/comments/?ids=https://www.marchofdimes.com/facebook/wpd/partners/index.html', function (data) {
// //	        console.log(">>>" + data.data[0].id);
// 			if(this.readystate == 4){
// 				console.log(xhr.responseText);
// 			}
// //	        var obj = $.parseJSON( data );
// //	        console.log(obj);
// //			alert(obj.comments.data[0].id);
// 		});

// //		$.getJSON( "https://graph.facebook.com/comments/?ids=https://www.marchofdimes.com/facebook/wpd/partners/index.html")
// //		  .done(function( json ) {
// //		    console.log( "JSON Data: " + json.data[ 3 ].id );
// //		  })
// //		  .fail(function( jqxhr, textStatus, error ) {
// //		    var err = textStatus + ", " + error;
// //		    console.log( "Request Failed: " + err );
// //		});

        </script>

    </body>
</html>
