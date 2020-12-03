<template>
  <div class="app">
    <AppHeader fixed>
      <SidebarToggler class="d-lg-none" display="md" mobile />

      <b-link class="navbar-brand" to="/">
<!--        <div class="navbar-brand-full">ADMIN QR</div>-->
<!--        <div class="navbar-brand-minimized">QR</div>-->
        <img class="navbar-brand-full" src="/admin/compiled/img/avatars/logo.png" width="50" height="50" alt="Smart Comment">
        <img class="navbar-brand-minimized" src="/admin/compiled/img/avatars/logo.png" width="50" height="50" alt="Smart Comment">
      </b-link>

      <SidebarToggler class="d-md-down-none" display="lg" />

      <!--<b-navbar-nav class="d-md-down-none">
        <b-nav-item class="px-3" href="https://gobig.kz">TOO "Рога и Копыта"</b-nav-item>
      </b-navbar-nav>-->

      <b-navbar-nav class="ml-auto">
        <DefaultHeaderDropdownAccnt/>
      </b-navbar-nav>
    </AppHeader>

    <div class="app-body">
      <AppSidebar fixed>
        <SidebarHeader/>
        <SidebarForm/>
        <SidebarNav :navItems="nav"></SidebarNav>
        <SidebarFooter/>
        <SidebarMinimizer/>
      </AppSidebar>
      <main class="main">
        <Breadcrumb :list="list"/>
        <div class="container-fluid">
          <router-view></router-view>
        </div>
      </main>
    </div>

    <TheFooter>
      <!--footer-->
      <div>
        <span class="ml-1">&copy; <a href="#">SmartCall</a> 2020</span>
      </div>
    </TheFooter>

  </div>
</template>

<script>
import nav from '@/_nav'
import { Header as AppHeader, SidebarToggler, Sidebar as AppSidebar, SidebarFooter, SidebarForm, SidebarHeader, SidebarMinimizer, SidebarNav, Footer as TheFooter, Breadcrumb } from '@coreui/vue'
import DefaultHeaderDropdownAccnt from './DefaultHeaderDropdownAccnt'

export default {
  name: 'DefaultContainer',
  components: {
    AppHeader,
    AppSidebar,
    TheFooter,
    Breadcrumb,
    DefaultHeaderDropdownAccnt,
    SidebarForm,
    SidebarFooter,
    SidebarToggler,
    SidebarHeader,
    SidebarNav,
    SidebarMinimizer
  },
  data () {
    return {
      nav: nav.items
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched.filter((route) => route.name || route.meta.label )
    }
  }
}
</script>
