<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <Link class="navbar-brand" href="#">Navbar</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <NavLink href="/" :active="$page.component === 'UserView/Home'">
                            Home
                        </NavLink>
                    </li>

                    <li class="nav-item">
                        <NavLink href="/users" :active="$page.component === 'UserView/User'">
                            Users
                        </NavLink>
                    </li>

                    <li class="nav-item">
                        <NavLink href="/" :active="$page.component === 'Home'">
                            {{ username }}
                        </NavLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {Link} from '@inertiajs/vue3';
    import NavLink from './NavLink.vue';
    export default{
        components: { Link, NavLink },
        computed: {
            username(){
                return this.$page.props.auth.username;
            }
        }
    }
</script>