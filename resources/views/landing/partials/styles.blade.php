<style>
    body {
        background-color: #f0F5F9;
    }

    .nav-link {
        color: var(--bs-body-color) !important;
    }
</style>

<style>
    .slick-slide {
        height: auto;
        outline: none;
    }

    .slick-next,
    .slick-prev {
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        background: transparent;
        border-radius: 50%;
        border: solid 1px #EBEBEB;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 1;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .slick-next:hover,
    .slick-next:focus,
    .slick-prev:hover,
    .slick-prev:focus {
        background: #FFF;
        border-color: #EBEBEB;
    }

    .slick-next:hover:before,
    .slick-next:focus:before,
    .slick-prev:hover:before,
    .slick-prev:focus:before {
        color: #FFA387;
    }

    .slick-prev {
        left: -30px;
    }

    .slick-prev:hover {
        background: #FE4F70;
    }

    .slick-next {
        right: -30px;
    }

    .slick-next:hover {
        background: #FE4F70;
    }

    .slick-prev:before,
    .slick-next:before {
        color: #909090;
        font-size: 10px;
        opacity: 1;
    }

    .slick-prev:before {
        content: "";
        font-family: "simple-line-icons";
        top: 9px;
        left: 9px;
        position: absolute;
    }

    .slick-next:before {
        content: "";
        font-family: "simple-line-icons";
        position: absolute;
        top: 9px;
        left: 9px;
    }

    .slick-dotted.slick-slider {
        margin-bottom: 0;
    }

    .slick-dots {
        position: relative;
        bottom: 0;
        padding: 0;
        margin: 25px 0 0;
    }

    .slick-dots li {
        width: 8px;
        height: 8px;
        margin: 0 5px;
    }

    .slick-dots li.slick-active {
        width: 25px;
        height: 8px;
    }

    .slick-dots li button {
        width: 20px;
        height: 20px;
        padding: 0;
    }

    .slick-dots li.slick-active button:before {
        background: #FE4F70;
        background: -webkit-linear-gradient(left, #FE4F70 0%, #FFA387 100%);
        background: linear-gradient(to right, #FE4F70 0%, #FFA387 100%);
        border-radius: 5px;
        opacity: 1;
        width: 25px;
    }

    .slick-dots li button:before {
        content: "";
        background: #d4d4d4;
        border-radius: 50%;
        opacity: 1;
        top: 8px;
        left: 8px;
        height: 8px;
        width: 8px;
    }

    .slick-arrows-top {
        position: absolute;
        top: 50%;
        right: 0;
        -webkit-transform: translate(0px, -50%);
        -moz-transform: translate(0px, -50%);
        -ms-transform: translate(0px, -50%);
        -o-transform: translate(0px, -50%);
        transform: translate(0px, -50%);
    }

    .slick-arrows-bot {
        position: relative;
        text-align: center;
        margin-top: 20px;
    }

    .slick-custom-buttons {
        color: #909090;
        font-size: 10px;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        background: #FFF;
        border-radius: 50%;
        border: solid 1px #EBEBEB;
        padding: 0;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .slick-custom-buttons:hover {
        color: #FE4F70;
        border-color: #FE4F70;
    }

    .img-car {
        background-size: cover;
        background-position: center center;
        height: 540px;
    }

    .carousel-indicators li {
        width: 10px !important;
        height: 10px !important;
        border-radius: 100%;
        list-style: none;
        /* background: #d4d4d4 !important; */
    }

    .carousel-control-next-icon,
    .carousel-control-prev-icon {
        /* background-color: rgba(0, 0, 0, 0.5); */
        /* border-radius: 50%; */

    }

    .know-more {
        position: absolute;
        bottom: 0;
        right: 0;
        margin-bottom: 0;
    }

    .custom-caption {
        position: absolute;
        bottom: 30px;
        left: 10px;
        /* background: rgb(2, 0, 36);
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.1) 25%, rgba(0, 212, 255, 0) 100%); */
    }

    .text-shadow {
        text-shadow: 0px 0px 20px #000000;
    }

    .inverted-radius-at-bottom-left::before {
        content: "";
        width: 40px;
        height: 40px;
        /* background: red; */
        position: absolute;
        /* margin-left: -50px; */
        left: -40px;
        bottom: 0px;
        box-shadow: 10px 10px 0 #FFF;
        border-bottom-right-radius: 50%;

    }

    .timeline {
        position: relative;
        border-left: 2px solid #dee2e6;
        margin-left: 1rem;
        padding-left: 2rem;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 3rem;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -2.6rem;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #dee2e6;
        border: 4px solid #fff;
        box-shadow: 0 0 0 2px #0d6efd;
    }

    .timeline-content {
        position: relative;
        padding: 1.5rem;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .timeline-content:hover {
        transform: translateY(-5px);
    }

    .timeline-date {
        position: absolute;
        left: -5.5rem;
        top: 0;
        color: #6c757d;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .timeline {
            margin-left: 0;
        }

        .timeline-date {
            position: relative;
            left: 0;
            margin-bottom: 0.5rem;
            display: block;
        }
    }
</style>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        line-height: 1.6;
    }

    .hero-section {
        position: relative;
        background: url('/assets/image/futuristic-smart-city-with-5g-global-network-technology_53876-98438.avif') no-repeat center center/cover;
        color: white;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .header-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 2;
        padding: 10px 20px;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .content-container {
        position: relative;
        z-index: 2;
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .features {
        background-color: #f8f9fa; /* Couleur similaire à celle des partenaires */
        padding: 50px 0;
    }

    .features .card {
        border: none;
        background: white;
        transition: transform 0.3s;
    }

    .features .card:hover {
        transform: translateY(-10px);
    }

    .cta-section {
        background-color: #127dc5;
        color: white;
        padding: 50px 0;
    }

    .partners {
        background-color: #f8f9fa; /* Couleur du fond */
    }

    .partner-card {
        border: none;
        transition: transform 0.3s;
        text-align: center;
        background-color: white;
    }

    .partner-card img {
        max-width: 150px;
        height: auto;
    }

    .partner-card:hover {
        transform: scale(1.05);
    }

    .contact {
        background-color: #f8f9fa; /* Couleur similaire à celle des partenaires */
        padding: 50px 0;
    }

    .contact .card {
        background: white;
        border: none;
        transition: transform 0.3s;
    }

    .contact .card:hover {
        transform: translateY(-10px);
    }

    .footer {
        background: #343a40;
        color: white;
    }

    .footer a {
        color: #f8f9fa;
    }

    /* Uniformiser la taille des icônes */
    .feature-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }
</style>
