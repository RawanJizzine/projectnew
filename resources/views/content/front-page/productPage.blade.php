@extends('layouts/layoutFront')
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'cinzel', serif;


        }

        .header-section {
            width: 100%;
            height: 100vh;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .header-section img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 1080px) {
            .header-section {
                height: 75vh;

            }

            .header-section img {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .header-section {
                height: 60vh;
            }

            .header-section img {
                max-width: 100%;
            }
        }

        @media (max-width: 720px) {
            .header-section {
                height: 60vh;
            }

            .header-section img {
                max-width: 1%;
            }
        }


        @media (max-width: 576px) {
            .header-section {
                height: 50vh;

            }

            .header-section img {
                max-width: 100%;
            }
        }


        .header-heading {
            font-size: 100px;
            text-transform: capitalize;
            color: #fff;
        }

        .header-heading span {
            color: #d5be8b;
        }

        .content {
            margin-left: 200px;
            margin-top: 400px;


        }

        .title-categori {

            font-size: 1.875rem;
            margin-top: 5vh;
            background-color: #ffffff;
            padding: 1rem;


        }

        @media only screen and (max-width: 767px) {
            .title-categori {
                font-size: 1.5rem;
                margin-left: 1rem;
                /* 24px */
            }
        }

        .content-cat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 120px;
            padding-right: 120px;



        }

        /* Styles for smaller screens */
        @media only screen and (max-width: 767px) {
            .content-cat {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                padding-right: 5px;
                padding-left: 5px;
            }
        }

        .category {

            width: calc(50% - 20px);
            max-width: 190px;
            height: 75px;
            margin: 10px;
            padding: 12px;
            border-radius: 15px;
            text-align: center;
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: #d9d213;
            /* Default background color */
        }


        .category:nth-child(2n) {
            background-color: #162797;
            /* Alternate background color */
        }



        .category-title {
            font-size: 20px;
            color: #333;
        }

        @media only screen and (max-width: 767px) {
            .category {
                width: calc(100% - 20px);
            }
        }

        .product {
            background: #c45688;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
            padding-top: 100%;
            margin-left: 1%;
            margin-right: 2%;
            margin-top: 4%;
        }

        /* ya houssein ya habibi ya houssein ya habibi ya houssein ya habibi ya houssein ya habibi  */
        .hthree {
            text-align: center;
            font-size: 30px;
            margin: 0;
            padding-top: 10px;
        }

        .aClass {
            text-decoration: none;

        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            justify-content: center;
            align-items: center;
            margin: 50px 0;
        }

        .content-product {
            width: 20%;
            margin: 15px;
            box-sizing: border-box;
            float: left;
            text-align: center;
            border-radius: 20px;
            cursor: pointer;
            padding-top: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            transition: .4s;
            background: #f2f2f2;

        }

        .imgClass {
            width: 200px;
            height: 200px;
            text-align: center;
            margin: 0 auto;
            display: block;
        }

        .pClass {
            text-align: center;
            color: #b2bec3;
            padding-top: 0 8px;
        }

        .hClass {
            font-size: 26px;
            text-align: center;
            color: #222f3e;
            margin: 0;
        }

        .ulClass {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 0;
            padding-left: 0;
        }

        .liClass {
            padding-top: 5px;

        }

        .fa {
            font-size: 26px;
            transition: .4s;
            margin: 3px;

        }

        .checked {
            color: #ff9f43;
        }

        .fa:hover {
            transform: scale(1.3);
            transition: .6s;

        }

        .buttonClass {
            text-align: center;
            font-size: 24px;
            color: #fff;
            width: 100%;
            padding: 15px;
            border: 0;
            outline: none;
            cursor: pointer;
            margin-top: 5px;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .buy-1 {
            background-color: #7367f0;
        }

        .buy-2 {
            background-color: #3b3e6e;
        }

        .buy-3 {
            background-color: #0b0b0b;
        }

        .buy-4 {
            background-color: #ff9f43;
        }

        @media (max-width:1000px) {
            .content-product {
                width: 45%;
            }
        }

        @media(max-width:750px) {
            .content-product {
                width: 100%;
            }
        }


        .category.border {
            border: 2px solid #7367f0;

        }


        .title-here {
            padding-left: 41%;
            padding-top: 3%;
        }

        .heading-here-title {
            text-align: center;
            padding: 2rem 0;
            padding-bottom: 3rem;
            font-size: 3.5rem;
            color: #7c7878;
        }

        .heading-span {
            background: #7367f0;
            color: #fff;
            padding: .5rem 3rem;
            clip-path: polygon(100% 0, 93% 50%, 100% 99%, 0% 100%, 7% 50%, 0% 0%);
        }
    </style>

</head>



<section id="hero-animation">
    <div id="landingHero" class="section-py landing-hero position-relative">
        <div class="content-cat">
            @foreach ($categoryy as $category)
                <div class="category @if ($categoryyId != null && $categoryyId == $category->id) active @endif" style="background-color: #fbdddd"
                    data-category-id="{{ $category->id }}">
                    <div><i style="color: #7367f0" class="fa {{ $category->icon }}"></i></div>
                    <div style="color: #7367f0" class="category-title">{{ $category->name }}</div>
                </div>
            @endforeach
        </div>

    </div>
    <h1 class="heading-here-title">Our <span class="heading-span"> Products </span></h1>
    <div class="gallery">

    </div>
    <div class="landing-hero-blank"></div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        const categories = document.querySelectorAll('.category');

        // Function to highlight the selected catfegory
        function highlightSelectedCategory(selectedCategory) {
            // Remove the border and shadow from all categories
            categories.forEach((cat) => {
                cat.classList.remove('border', 'border-primary', 'shadow-lg');
            });

            // Add border and shadow to the selected category
            selectedCategory.classList.add('border', 'border-primary', 'shadow-lg');
        }

        // Function to fetch data based on category ID
        function fetchData(categoryId) {
            // Make an AJAX request to the controller
            fetch(`/categories/${categoryId}`)
                .then((response) => response.json())
                .then((data) => {
                    // Display the data in the .gallery container
                    const galleryContainer = document.querySelector('.gallery');
                    galleryContainer.innerHTML = '';
                    data.forEach((product) => {
                        const productHTML = `
                        
                    <div class="content-product" >
                        <a href="/productDetailsPage?id=${product.id}">   
                        <img class="imgClass" src="/images/${product.image}" alt="${product.title}">
                        <h3 class="hthree">${product.title}</h3>
                        <p class="pClass">${product.description}</p>
                        <h6 class="hClass">$${product.price}.00</h6>
                        <ul class="ulClass">
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                        </ul>  
                    </a>
                        <button class="buttonClass buy-1" data-product-id="${product.id}"     >ADD TO CART</button>
                    </div>
               
              
                    `;

                        galleryContainer.innerHTML += productHTML;
                    });

                    document.querySelectorAll('.buy-1').forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            const productId = this.getAttribute('data-product-id');
                            console.log("hi")
                            addToCart(productId);
                        });
                    });

                })



                .catch((error) => console.error(error));
        }

        function addToCart(productId) {
            fetch(`/add-to-cart/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        productId: productId
                    })
                })
                .then(response => {
                    if (response.ok) {
                        console.log("done");
                    } else {
                        console.error('Failed to add to cart');
                    }
                })
                .catch(error => console.error('Error:', error));
        }


        // Add event listener to each category element
        categories.forEach((category) => {
            category.addEventListener('click', (e) => {
                // Remove the active class from all categories
                categories.forEach((cat) => cat.classList.remove('active'));

                // Add the active class to the clicked category
                category.classList.add('active');

                // Highlight the selected category
                highlightSelectedCategory(category);

                // Get the category ID from the element
                const categoryId = category.dataset.categoryId;

                // Fetch data based on category ID
                fetchData(categoryId);
            });
        });

        // Highlight the initially selected category or select the first category if categoryId is null
        const initiallySelectedCategory = document.querySelector('.category.active');
        if (initiallySelectedCategory) {
            highlightSelectedCategory(initiallySelectedCategory);
            const categoryId = initiallySelectedCategory.dataset.categoryId;
            fetchData(categoryId);
        } else {
            const firstCategory = document.querySelector('.category');
            if (firstCategory) {
                firstCategory.classList.add('active');
                highlightSelectedCategory(firstCategory);
                const categoryId = firstCategory.dataset.categoryId;
                fetchData(categoryId);
            }
        }
    });
</script>
