<template>
  <div >

    <My-nav></My-nav>

    <div class="container-fluid">
      <div class="row">

        <My-sidebar></My-sidebar>
        
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        
          <router-view></router-view>

        </main>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

