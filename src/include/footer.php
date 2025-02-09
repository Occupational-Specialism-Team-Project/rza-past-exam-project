        </main>

        <footer class="shadow-up text-white rza-green">
            <div class="container text-center mx-auto">
                <div class="row">
                    <div class="col-md-1 my-4 mx-auto">
                        <a class="fs-1 rza-brand" href="index.php"><i class="fa-solid fa-paw"></i></a>
                    </div>
                    <div class="col-md-3 my-4 mx-auto">
                        <div class="card mx-auto bg-transparent text-white h-100" style="width: 18rem;">
                            <div class="card-header">
                                <h5 class="card-title">Contact</h5>
                            </div>
                            <div class="card-body">
                                <address class="card-text">
                                    <a href="tel:+14155550132" class="text-white">+1 (415) 555‑0132</a><br />
                                    <a href="mailto:jim@rza-zoo.com" class="text-white">jim@rza-zoo.com</a>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 my-4 mx-auto">
                        <div class="card mx-auto bg-transparent text-white h-100" style="width: 18rem;">
                            <div class="card-header">
                                <h5 class="card-title">Location</h5>
                            </div>
                            <div class="card-body">
                                <address class="card-text">
                                    Riget Zoo Adventures<br />
                                    220 Discovery Lane<br />
                                    Trekking Forest<br />
                                    United Kingdom<br />
                                    TF53 1AA
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 my-4 mx-auto">
                        <div class="card mx-auto bg-transparent text-white h-100" style="width: 18rem;">
                            <div class="card-header">
                                <h5 class="card-title">Details</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Riget Zoo Adventures is a business that offers a safari-style wildlife zoo, an on-site hotel, and educational visits.
                                    This website is to allow customers to access help and information, book tickets for the zoo and reservations for the hotel,
                                    and also to provide educational materials.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <?php if (basename($_SERVER["PHP_SELF"]) == "zoo_booking.php"): ?>
            <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <script src="include/calendar.js"></script>
            <script src="include/zoo_booking_validation.js"></script>
        <?php endif ?>
        <script type="text/javascript">
            var MAX_ZOO_VISITORS = <?=MAX_ZOO_VISITORS?>;
            var MAX_TICKET_DURATION = <?=MAX_TICKET_DURATION?>;
        </script>
        <!-- Add extra JavaScript here -->
    </body>
</html>