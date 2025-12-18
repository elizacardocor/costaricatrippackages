import ReactDOM from 'react-dom/client';
import DashboardMUI from './components/DashboardMUI';

// Render Dashboard MUI
const dashboardRoot = document.getElementById('dashboard-mui');
if (dashboardRoot) {
    const root = ReactDOM.createRoot(dashboardRoot);
    root.render(<DashboardMUI />);
}
