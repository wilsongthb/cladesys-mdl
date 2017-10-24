<template id="top-menu-template">
    <div>
        
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= url('') ?>"><?= config('app.name') ?></a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- <li class="active"><a href="#">Link</a></li> -->
                    <!-- <li class="active"><a class="navbar-brand" href="<?= $appUrl ?>"><?= $appName ?></a></li> -->
                    <!-- <router-link tag="li" active-class="active" class="nav-link" to="/"><a href=""><?= $appName ?></a></router-link> -->
                    <li><router-link class="nav-link" to="/"><?= $appName ?></router-link></li>
                    <!-- <li><a href="#">Link</a></li> -->
                </ul>
                <links-navigation></links-navigation>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        <page-content></page-content>
    </div>
</template>
<script>
const TopMenu = {
    template: '#top-menu-template',
    components: {
        'PageContent': PageContent,
        'LinksNavigation': LinksNavigation
    }
}
</script>