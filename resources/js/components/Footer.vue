<template>
    <div>
        <!-- Footer Section Begin -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer__about">
                            <div class="footer__logo">
                                <a href="#"><img src="../components/img/blanc.png" alt=""></a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2 offset-lg-2 col-md-3 col-sm-6">
                        <div class="footer__widget">
                            <h6>Les Pages</h6>
                            <ul>
                                <li>
                                    <router-link to="/">Home</router-link>
                                </li>
                                <li>
                                    <router-link to="/listeEvent">Evènement</router-link>
                                </li>
                                <li>
                                    <router-link to="/ListePubic">Publication</router-link>
                                </li>
                                <li><router-link to="/aboutus">A Propos</router-link></li>
                            </ul>

                        </div>
                    </div>

                    <div class="col-lg-3 offset-lg-2 col-md-6 col-sm-6">
                        <div class="footer__about">
                            <p>
                                Notre site offre aux utilisateurs la possibilité de découvrir les meilleurs bons plans en
                                fonction de leur ville,
                                tout en facilitant la visualisation des événements et la réservation de billets.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="footer__copyright__text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            <p>Copyright ©
                                Eventy.tn <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->
    </div>
</template>

<script setup>

</script>

<style scoped></style>
