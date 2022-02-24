<!doctype html>
<html>
<head>
 
   <meta name="robots" content="noindex,nofollow">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Barriecito&display=swap');
  </style>

   <title>AJAX Pet Adoption Agency</title>
   <style>
       #myForm div{
        margin-bottom:2%;
        }
   </style>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
   
</head>
<body>
<h2>AJAX Pet Adoption Agency</h2>
<p>Make some changes and reveal your pet!</p>
<div id="output">
<form id="myForm" action="" method="get">

   <div id="pet_feels">
       <h3>Feels</h3>
       <p>Please choose how you would like your pet to feel:</p>
       <input type="radio" name="feels" value="fluffy" required="required">fluffy <br />
       <input type="radio" name="feels" value="scaly">scaly <br />
   </div>
   <div id="pet_likes">
       <h3>Likes</h3>
       <p>Please tell us what your pet will like:</p>
       <input type="radio" name="likes" value="petted" required="required">to be petted <br />
       <input type="radio" name="likes" value="ridden">to be ridden <br />
   </div>
    <div id="pet_eats">
       <h3>Eats</h3>
       <p>Please tell us what your pet likes to eat:</p>
       <input type="radio" name="eats" value="carrots" required="required">carrots <br />
       <input type="radio" name="eats" value="pets">other people's pets <br />
   </div>
  
    <div id="pet_name">
      <label >Pet Name</label>
      <input type="text"  name="name" placeholder="Enter your pets name..." 
      required="required" autofocus>
   </div>

   <div><input type="submit" value="submit it!" /></div>
</form>
</div>
<p><a href="index.php">RESET</a></p>
<script>

  function titleCase(str) {
    str = str.toLowerCase().split(' ');
    for (var i = 0; i < str.length; i++) {
    str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
}
    return str.join(' ');
}

    $("document").ready(function(){
        
        //hide likes and eats
        $('#pet_likes').hide();
        $('#pet_eats').hide();
        $('#pet_name').hide();

        //onclick of feels, likes is shown
        $('#pet_feels').click(function(){
          $('#pet_likes').slideDown(200);
        });

        //onclick of likes, eats is shown
        $('#pet_likes').click(function(){
          $('#pet_eats').slideDown(200);
        });

        //onclick of eats, enter name is shown
        $('#pet_eats').click(function(){
          $('#pet_name').slideDown(200);
        });

        $('#myForm').submit(function(e){
            e.preventDefault();//no need to submit as you'll be doing AJAX on this page
            let feels = $("input[name=feels]:checked").val();
            let likes = $("input[name=likes]:checked").val();
            let eats = $("input[name=eats]:checked").val();
            let name = $("input[name=name]").val();
            let titleName = titleCase(name);
            titleName = `<span style="color:blue">${titleName}</span>`;

            titleName = `<span style="font-family: 'Barriecito', cursive;">${titleName}</span>`;

            let pet = "";
            var output = '';

            if(feels=="fluffy" && likes=="petted" && eats=="carrots"){
              pet="rabbit";
            }

            if(feels=="fluffy" && likes=="petted" && eats=="pets"){
              pet="bulldog";
            }

            if(feels=="fluffy" && likes=="ridden" && eats=="carrots"){
              pet="bird";
            }

            if(feels=="fluffy" && likes=="ridden" && eats=="pets"){
              pet="dane";
            }

            if(feels=="scaly" && likes=="petted" && eats=="carrots"){
              pet="pig";
            }

            if(feels=="scaly" && likes=="petted" && eats=="pets"){
              pet="pom";
            }

            if(feels=="scaly" && likes=="ridden" && eats=="carrots"){
              pet="lab";
            }

            if(feels=="scaly" && likes=="ridden" && eats=="pets"){
              pet="velociraptor";
            }

            //alert(feels);

          //Where we'll store all data to show

          output+=`<p>Congratulations! You have a new pet ${pet} named:</p>`;
          output+=`<p>${titleName}</p>`;
          output+=`<p>Your pet feels ${feels}.</p>`;
          output+=`<p>Your pet likes to be ${likes}.</p>`;
          output+=`<p>Your pet likes to eat ${eats}.</p>`;
          
          //here we get data from server side page using ajax
          $.get( "includes/get_pet.php", { critter: pet } )
          .done(function( data ) {
          //alert( "Data Loaded: " + data );
          $('#output').html(data + output);
          })
          
          .fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage);
           })

          ;

          //lets output info about the pet to the page
          

        });

    });

   </script>
</body>
</html>
