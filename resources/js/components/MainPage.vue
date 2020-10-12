<template>
    <div>
        <div v-if="$store.state.user">
            <b-navbar toggleable="lg" type="light" variant="light" fixed="top">
            <b-container>
                <b-navbar-brand router-link to="/">iDiary</b-navbar-brand>

                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                <b-collapse id="nav-collapse" is-nav>

                <b-navbar-nav>
                    <b-nav-item router-link to="blog"><b-icon icon="house" font-scale="1.5" class="gear-icon"></b-icon></b-nav-item>
                    <b-nav-item router-link to="about"><b-icon icon="question-circle" font-scale="1.5" class="gear-icon"></b-icon></b-nav-item>
                </b-navbar-nav>
                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-form>
                    <b-form-input size="sm" class="mr-sm-2" placeholder="Search"></b-form-input>
                    <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
                    </b-nav-form>

                    <b-nav-item-dropdown right>
                    <template v-slot:button-content>
                        <em><b-icon icon="gear" font-scale="1.5" class="gear-icon"></b-icon></em>
                    </template>
                    <b-dropdown-item router-link to="settings">Change Password</b-dropdown-item>
                    <b-dropdown-item href="#">Edit Profile</b-dropdown-item>
                    <b-dropdown-item router-link to="#">Sign Up</b-dropdown-item>
                    <b-dropdown-item href="#">FA</b-dropdown-item>
                    </b-nav-item-dropdown>

                    <b-nav-item-dropdown right>
                    <!-- Using 'button-content' slot -->
                    <template v-slot:button-content>
                        <em><b-icon icon="person" font-scale="1.5" class="gear-icon"></b-icon></em>
                    </template>
                    <b-dropdown-item router-link to="profile">Profile</b-dropdown-item>
                    <b-dropdown-item href="/logout">Sign Out</b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
                </b-collapse>
            </b-container>
            </b-navbar>
        </div>
        <router-view></router-view>

    <!-- Footer -->
    <!-- <mdb-footer color="indigo" class="font-small pt-0">
        <mdb-container>
        <hr class="rgba-white-light" style="margin: '0 15%'" />
        <mdb-row class="d-flex text-center justify-content-center mb-md-0 mb-4">
            <mdb-col md="8" sm="12" class="mt-5">
            <p style="lineHeight: '1.7rem'">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                doloremque laudantium,
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                aut fugit, sed quia consequuntur.</p>
            </mdb-col>
        </mdb-row>
        <hr class="clearfix d-md-none rgba-white-light" style="margin: '10% 15% 5%'" />
        <mdb-row class="pb-3">
            <mdb-col md="12">
            <div class="mb-5 flex-center">
                <a class="fb-ic"><i class="fab fa-facebook fa-lg white-text mr-md-4"> </i></a>
                <a class="tw-ic"><i class="fab fa-twitter fa-lg white-text mr-md-4"> </i></a>
                <a class="gplus-ic"><i class="fab fa-google-plus fa-lg white-text mr-md-4"> </i></a>
                <a class="li-ic"><i class="fab fa-linkedin-in fa-lg white-text mr-md-4"> </i></a>
                <a class="ins-ic"><i class="fab fa-instagram fa-lg white-text mr-md-4"> </i></a>
                <a class="pin-ic"><i class="fab fa-pinterest fa-lg white-text"> </i></a>
            </div>
            </mdb-col>
        </mdb-row>
        </mdb-container>
        <div class="footer-copyright text-center py-3">
        <mdb-container fluid>
            &copy; 2020 Copyright: <a href="https://www.idiary.com"> iDiary </a>
        </mdb-container>
        </div>
    </mdb-footer> -->
    <!-- Footer -->

    </div>
</template>

<script>
export default {
    props : ['user'],

    data() {
        return {
            isLoggedIn : true,
        }
    },

    created() {
        this.$store.commit('userDetails', this.user)
    }
}
</script>