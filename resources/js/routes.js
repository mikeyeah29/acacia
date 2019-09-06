import OrderForm from './components/OrderForm';
import Orders from './components/Orders';
import NotFound from './components/NotFound';

export default {
	mode: 'history',
	base: '/acacia/public/',
	linkActiveClass: 'is-active',
	routes: [
		{
			path: '*',
			component: NotFound
		},
		{
			path: '/',
			component: OrderForm
		},
		{
			path: '/orders',
			component: Orders
		}
	]
}