<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <a href="https://shouts.dev/" target="_blank"><img src="https://www.wpoint.co.uk/images/scc-logo.jpg"></a><br>
            <span class="text-secondary">Candidate Control System</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link to="/" class="nav-item nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/add" class="nav-item nav-link">Add Candidate</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <br/>
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {}
</script>