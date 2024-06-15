@extends('layouts/layoutFront')
<html lang="en">

<head>
  <title>Harvest vase</title>
  <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
  <style>
  body {
    padding-top: 8%;
    background: linear-gradient(138.18deg, #eae8fd 0%, #fce5e6 94.44%);
    font-family: Arial, sans-serif; /* Added a fallback font */
  }

  .wrapper {
    max-width: 900px; /* Changed width to max-width for responsiveness */
    margin: 0 auto;
    padding: 20px; /* Added padding for better spacing */
    border-radius: 7px;
    
    overflow: hidden;
     /* Added overflow to contain floats */
  }

  .product-img {
    float: left;
    width: 45%; /* Adjusted width for responsiveness */
  }

  .product-img img {
    width: 100%; /* Made image responsive within its container */
    border-radius: 7px 0 0 7px;
  }

  .product-info {
    float: left;
    height: 37.5rem; /* Fixed height */
    width: 55%; /* Adjusted width for responsiveness */
    background-color: #ffffff;
    border-radius: 0 7px 7px 0;
    overflow-y: auto; /* Adds a scrollbar if content overflows */
    overflow-x: hidden; /* Prevents horizontal overflow */
  }

  .product-text {
    padding: 20px;
    background-color: #ffffff;
    width: 100%; /* Ensures full width of the container */
    max-width: 600px; 
    height: 468px;
    /* Fixed maximum width */
    box-sizing: border-box; /* Includes padding in the width calculation */
    margin: 0 auto; /* Centers the element horizontally */
    color: #fff;

     /* Added padding for better spacing */
  }

  .product-text h1 {
    font-size: 24px; /* Adjusted font size for better readability */
    margin-bottom: 10px; /* Added margin for better spacing */
  }

  .product-text h2 {
    font-size: 14px; /* Adjusted font size for better readability */
    margin-bottom: 20px; /* Added margin for better spacing */
    text-transform: uppercase;
    color: #d2d2d2;
    letter-spacing: 0.2em;
  }

  .product-text p {
    font-size: 14px; /* Adjusted font size for better readability */
    color: #8d8d8d;
    line-height: 1.5em;
    margin-bottom: 20px; /* Added margin for better spacing */
  }
  .button-here{
  float: right;
  display: inline-block;
  height: 50px;
  width: 176px;
 
  box-sizing: border-box;
  border: transparent;
  border-radius: 60px;
  font-family: 'Raleway', sans-serif;
  font-size: 14px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.2em;
  color: #ffffff;
  background-color: #9cebd5;
  cursor: pointer;
  outline: none;
}

.text-here  {

  
  font-family: 'Playfair Display', serif;
  color: #8d8d8d;
  
  font-size: 30px;
  font-weight: bold;
 
}

  

  @media screen and (max-width: 768px) {
    .wrapper {
      max-width: 100%; /* Adjusted max-width for smaller screens */
    }

    .product-img,
    .product-info {
      width: 100%; /* Made product info and image full width for smaller screens */
      float: none;
       /* Removed float for better stacking */
    }

    .product-img img {
      border-radius: 7px 7px 0 0; /* Adjusted border radius for better appearance */
    }

    .product-price-btn button {
      width: 60%;
      margin: 0 10px 0 0;
      

       /* Made button full width for smaller screens */
    }
  }

    </style>
</head>

<body style="background: linear-gradient(138.18deg, #eae8fd 0%, #fce5e6 94.44%);"  >
  <div class="wrapper">
    <div class="product-img">
      <img src="http://bit.ly/2tMBBTd" height="600" width="450">
    </div>
    <div class="product-info">
      <div   class="product-text">
        <h1>{{$product->title }}</h1>
        <h2>by {{$product->category->name}}</h2>
        <p> {{$product->description}} </p>
       
      </div>
      <div style="  padding:20px; padding-top:55px;       display: flex; justify-content: space-between; align-items: center;">
        <p class="text-here"  ><span>{{$product->price}}</span>$</p>
        <button class="button-here"  type="button">ADD TO CART</button>
    </div>
    
    </div>
  </div>

</body>

</html>