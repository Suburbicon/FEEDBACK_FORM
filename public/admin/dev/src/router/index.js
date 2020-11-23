import Vue from 'vue'
import Router from 'vue-router'
import store from '../storage/index'

Vue.use(Router)

const ifNotAuthenticated = (to, from, next) => {
    store.dispatch('auth/isAuthenticated').then((isAuthenticated) => {
        if (!isAuthenticated) {
            next()
            return
        }
        next('/')
    })
}

const ifAuthenticated = (to, from, next) => {
    store.dispatch('auth/isAuthenticated').then((isAuthenticated) => {
        if (isAuthenticated) {
            next()
            return
        }
        next('/login')
    })
}

export default new Router({
    mode: 'history',
    linkActiveClass: 'open active',
    routes: [
        {
            path: '/login',
            name: 'Login',
            beforeEnter: ifNotAuthenticated,
            component: () => import('../views/auth/Login')
        },
        {
            path: '/',
            redirect: '/dashboard',
            name: 'Главная',
            beforeEnter: ifAuthenticated,
            component: () => import('../containers/DefaultContainer'),
            children: [
                {
                    path: 'dashboard',
                    name: 'Доска',
                    component: () => import('../views/Dashboard')
                },
                {
                    path: 'settings',
                    name: 'Основные',
                    component: () => import('../views/settings/Settings'),
                    children: [{
                        path: '1',
                        name: 'Статусы',
                        component: () => import('../views/settings/Settings')
                    }, {
                        path: '2',
                        name: 'Виды услуг',
                        component: () => import('../views/settings/Settings')
                    }, {
                        path: '3',
                        name: 'Виды деятельности',
                        component: () => import('../views/settings/Settings')
                    }, {
                        path: '4',
                        name: 'Справочник банков',
                        component: () => import('../views/settings/Settings')
                    }, {
                        path: '5',
                        name: 'Общие настройки',
                        component: () => import('../views/settings/Settings')
                    }]
                },
                {
                    path: 'orders',
                    name: 'Заявки',
                    component: () => import('../views/orders/Orders')
                },
                {
                    path: 'members',
                    name: 'Клиенты',
                    component: () => import('../views/members/Members')
                },
                {
                    path: 'city',
                    name: 'Список городов',
                    component: () => import('../views/citys/Citys')
                },
                {
                    path: 'appeals',
                    name: 'Обращения',
                    component: () => import('../views/appeals/Appeals')
                },
                {
                    path: 'departments',
                    name: 'Список ЦОНов',
                    component: () => import('../views/departments/Departments')
                },
                {
                    path: 'sectors',
                    name: 'Список секторов',
                    component: () => import('../views/sectors/Sectors')
                },
                {
                    path: 'companies',
                    name: 'Компании',
                    component: () => import('../views/companies/Companies')
                },
                {
                    path: 'segmentation',
                    name: 'Сегментация',
                    component: () => import('../views/segmentation/Segmentation')
                },
                {
                    path: 'logs',
                    name: 'Логи',
                    component: () => import('../views/logs/Logs')
                },
                {
                    path: 'users',
                    meta: {label: 'Users'},
                    component: {
                        render(c) {
                            return c('router-view')
                        }
                    },
                    children: [
                        {
                            path: '',
                            component: () => import('../views/users/Users'),
                        },
                        {
                            path: ':id',
                            meta: {label: 'User Details'},
                            name: 'User',
                            component: () => import('../views/users/User'),
                        }
                    ]
                }
            ]
        },
        {
            path: '*',
            component: () => import('../views/pages/Page404'),
        }
    ]
})
