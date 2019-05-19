import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';
import About from '@/js/components/About';
import Product from '@/js/components/Product';
import ProductEdit from '@/js/components/ProductEdit';
import Company from '@/js/components/company';
import CompanyEdit from '@/js/components/companyEdit';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/view/home',
            name: 'home',
            component: Home
        },
        {
            path: '/view/about',
            name: 'about',
            component: About
        },
        {
            path: '/view/product',
            name: 'product',
            component: Product
        },
        {
            path: '/view/product/edit',
            name: 'productEdit',
            component: ProductEdit,
            props: true
        },
        {
            path: '/view/company',
            name: 'company',
            component: Company
        },
        {
            path: '/view/company/edit',
            name: 'companyEdit',
            component: CompanyEdit,
            props: true
        }
    ]
});

export default router;
