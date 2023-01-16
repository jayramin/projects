<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}
.gallery {
  float: left;
  width: 25%;
  height: 300px; 
  padding: 20px;
}

.imageGallery{
      position:relative;
      padding:0;
      width:300px;
      display:block;
      cursor:pointer;
      overflow:hidden;
      }
      .content {
      opacity:0;
      font-size: 40px;
      position:absolute;
      top:0;
      left:0;
      color:#1c87c9;
      background-color:rgba(200,200,200,0.5);
      width:300px;
      height:300px;
      -webkit-transition: all 400ms ease-out;
      -moz-transition: all 400ms ease-out;
      -o-transition: all 400ms ease-out;
      -ms-transition: all 400ms ease-out;
      transition: all 400ms ease-out;
      text-align:center;
      }
      .imageGallery .content:hover { opacity:1; }      
      .imageGallery .content .text {
      height:0;
      opacity:1;
      transition-delay: 0s;
      transition-duration: 0.4s;
      }
      .imageGallery .content:hover .text {
      opacity:1;
      transform: translateY(250px);
      -webkit-transform: translateY(250px);
      }

</style>
</head>
<body>


<div>
  <div class="gallery">
    <div class="imageGallery">
      <img src="images/img1.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 1</div>
      </div>
    </div>
  </div class="gallery"> 

   <div class="gallery">
   <div class="imageGallery">
      <img src="images/img2.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 2</div>
      </div>
    </div>
  </div class="gallery">

   <div class="gallery">
    <div class="imageGallery">
      <img src="images/img3.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 3</div>
      </div>
    </div>
  </div class="gallery">
  <div class="gallery">
    <div class="imageGallery">
      <img src="images/img4.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 4</div>
      </div>
    </div>
  </div class="gallery">

</div>


  <div class="gallery">
    <div class="imageGallery">
      <img src="images/img5.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 5</div>
      </div>
    </div>
  </div class="gallery">



  <div class="gallery">
    <div class="imageGallery">
      <img src="images/img6.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 6</div>
      </div>
    </div>
  </div class="gallery">

   <div class="gallery">
    <div class="imageGallery">
      <img src="images/img7.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 7</div>
      </div>
    </div>
  </div class="gallery">

   <div class="gallery">
    <div class="imageGallery">
      <img src="images/img8.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 8</div>
      </div>
    </div>
  </div class="gallery">
  <div class="gallery">
    <div class="imageGallery">
      <img src="images/img9.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 9</div>
      </div>
    </div>
  </div class="gallery">
  <div class="gallery">
    <div class="imageGallery">
      <img src="images/img10.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 10</div>
      </div>
    </div>
  </div class="gallery">
   <div class="gallery">
    <div class="imageGallery">
      <img src="images/img11.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 11</div>
      </div>
    </div>
  </div class="gallery">
   <div class="gallery">
    <div class="imageGallery">
      <img src="images/img12.jpg" 
        width="300" height="250" alt="tree" />
      <div class="content">
        <div class="text" style="margin-top: -131px;">Nature 12</div>
      </div>
    </div>
  </div class="gallery">


</body>
</html>
