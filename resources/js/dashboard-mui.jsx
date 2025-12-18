import React from 'react';
import { createRoot } from 'react-dom/client';
import DashboardMUI from './components/DashboardMUI.jsx';

const container = document.getElementById('dashboard-mui');
if (container) {
    const root = createRoot(container);
    root.render(<DashboardMUI />);
}
