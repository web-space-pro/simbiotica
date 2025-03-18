<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package simbiotica
 */

?>
<?php if (!is_front_page()): ?>
    <footer class="flex justify-between w-full  bottom-0 md:sticky z-40 items-center flex-row xs:flex-col lg:flex-row gap-4 bg-white backdrop-blur-md px-[2.8vmax] pt-[1vmax] pb-[2.2vmax] xs:pb-[1vmax]">
        <div class="flex lg:basis-4/5 justify-between items-start">
            <nav class="flex flex-row" role="navigation">
                <?php footer_nav(); ?>
            </nav>
        </div>
        <div class="xs:w-full">
            <div class="flex flex-col xs:flex-row justify-between items-end xs:items-center">
                <div class="xs:mb-0 mb-8 order-1">
                    <a href="<?=get_home_url()?>" target="_self">
                        <svg width="62" height="40" viewBox="0 0 62 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M49.3283 32.0506C49.3283 32.0506 44.3305 25.5187 46.4919 21.7312C48.6532 17.9436 46.4919 13.0561 49.5022 11.0375C52.5126 9.01902 61.4737 13.8347 61.9691 24.7419C62.4645 35.6491 56.9506 46.8398 49.3283 32.0506Z" fill="#3F4042" />
                            <path d="M24.3926 36.6659C23.0104 35.2843 22.3448 33.4983 21.8739 31.7368C21.3899 29.9205 21.6262 28.1666 22.1103 26.3484C22.5811 24.587 22.6587 22.3794 24.0409 21.0054C25.4232 19.6314 27.6677 19.7051 29.4301 19.2364C31.2472 18.7506 33.1609 17.6072 34.978 18.091C36.7404 18.5616 38.0962 20.2059 39.4784 21.5875C40.8607 22.9691 41.3448 24.6342 41.8156 26.3957C42.2997 28.212 43.3964 30.102 42.9124 31.9201C42.4415 33.6816 40.8966 35.0878 39.5087 36.4713C38.1208 37.8547 36.7026 39.3384 34.9402 39.809C33.1211 40.2928 31.1111 39.7618 29.2939 39.276C27.5373 38.8073 25.7749 38.0494 24.3926 36.6659Z" fill="#3F4042" />
                            <path d="M15.9705 0.531027C14.4029 -0.820323 13.2627 0.517797 10.9198 3.2961C9.51296 4.96686 7.20603 6.47319 5.81431 8.79411C4.54739 10.9279 3.71917 13.4189 2.64702 15.5905C1.42737 18.0664 0.566999 20.5197 0.173687 22.9389C-0.274462 25.6737 0.230415 28.2044 0.718273 30.5953C0.782564 30.9166 0.845595 31.2353 0.907366 31.5516C0.907366 31.5516 1.83203 37.1838 4.12194 39.0643C4.12194 39.0643 4.13328 39.0643 4.13706 39.0643C5.7538 40.1511 7.87731 40.1265 9.65478 39.809C11.6913 39.4442 14.3008 38.7223 15.5072 36.5355C16.6966 34.3979 16.7344 31.6348 17.4246 29.1759C18.1018 26.7825 18.5881 24.3393 18.8787 21.8691C19.1775 19.3176 18.9468 16.8134 18.9165 14.4187C18.8844 11.6877 18.8409 9.19101 18.4986 7.00617C17.9389 3.43029 16.9235 1.35318 15.9705 0.531027Z" fill="#3F4042" />
                        </svg>
                    </a>
                </div>
                <p class="normal-case text-gray-20 font-sans text-right xs:order-2 order-3">© 2025. Symbiotica</p>
                <div class="flex items-center gap-1 font-medium xs:mb-0 mb-4 order-2 xs:order-3">
                    <button class="lowercase text-gray-20">en</button>
                    <div>/</div>
                    <button class="lowercase underline underline-offset-4">ru</button>
                </div>
            </div>
        </div>
    </footer>
<?php endif; ?>

<button id="scrollTopBtn"
        class="fixed z-[50] bottom-20 right-5 hidden bg-black text-white-10 p-2 w-10 rounded-lg shadow-lg hover:bg-gray-10 transition">
    &#8679;
</button>

<?php wp_footer(); ?>

</body>
</html>
