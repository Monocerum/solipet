<style>
    footer {
        background: linear-gradient(180deg, #F2D5BC 0%, #E3A168 100%);;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        padding: 5%;
        text-align: center;

        p {
            color: black;
        }

        .contact-logo {
            width: 3em;
        }
        
        .contact-logo, .solipet-logo-dark {
            transition: transform 0.3s ease-in, color 0.3s ease-in;
            cursor: pointer;
        }
        
        .contact-logo:hover, .solipet-logo-dark:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-out, color 0.3s ease-out;
        }
    }
</style>

<footer>
        <div class="footer-logo">
            <a href="/"><img src="assets/brand-logo-dark.svg" alt="Logo of Solipet" class="solipet-logo-dark"></a>
        </div>
        <div class="footer-copyright">
            <p>&copy; 2025 Solipet. All Rights Reserved. <br> Unauthorized use or reproduction of content is strictly prohibited.</p>
        </div>
        <div class="footer-contacts">
            <a href="https://www.facebook.com/" target="_blank" class="contact-img"><img src="assets/fb-logo.png" alt="Logo of Facebook" class="contact-logo"></a>
            <a href="https://www.instagram.com/" target="_blank" class="contact-img"><img src="assets/ig-logo.png" alt="Logo of Instagram" class="contact-logo"></a>
            <a href="https://x.com/?lang=en" target="_blank" class="contact-img"><img src="assets/twitter-logo.png" alt="Logo of Twitter" class="contact-logo"></a>
        </div>
</footer>