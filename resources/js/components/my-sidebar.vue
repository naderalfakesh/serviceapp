<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link " href="/view/home" :class="this.$route.name=='home' ? 'active ' : '' " >
            Dashboard <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/view/about" :class="this.$route.name=='about' ? 'active' : '' " >
            About 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/view/product" :class="this.$route.name=='product' ? 'active' : '' " >
            Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/view/company" :class="this.$route.name=='company' ? 'active' : '' " >
            Companies
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/view/contact" :class="this.$route.name=='contact' ? 'active' : '' " >
            Contacts
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
            Customers
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
            Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
            Integrations
            </a>
        </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="d-flex align-items-center text-muted" href="#">
        </a>
        </h6>
        <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link" href="#">
            Current month
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
            Last quarter
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
            Social engagement
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
            Year-end sale
            </a>
        </li>
        </ul>
    </div>
</nav>
</template>

<script>
export default {

}
</script>

<style>

</style>