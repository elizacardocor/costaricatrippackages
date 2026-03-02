import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

const salesData = [
    { mes: 'Ene', ventas: 4000 },
    { mes: 'Feb', ventas: 3000 },
    { mes: 'Mar', ventas: 5000 },
    { mes: 'Abr', ventas: 4500 },
    { mes: 'May', ventas: 6000 },
    { mes: 'Jun', ventas: 5500 },
];

const tourPackages = [
    { id: 1, nombre: 'Arenal Volcano Tour', precio: '$299', estado: 'Activo', reservas: 45 },
    { id: 2, nombre: 'Manuel Antonio Beach', precio: '$199', estado: 'Activo', reservas: 38 },
    { id: 3, nombre: 'Monteverde Cloud Forest', precio: '$249', estado: 'Activo', reservas: 52 },
    { id: 4, nombre: 'Tortuguero National Park', precio: '$399', estado: 'Pausado', reservas: 28 },
    { id: 5, nombre: 'Tamarindo Surf Package', precio: '$179', estado: 'Activo', reservas: 61 },
];

export default function DashboardMUI() {
    const [showMenu, setShowMenu] = useState(true);

    return (
        <div className="d-flex" style={{ minHeight: '100vh', backgroundColor: '#f5f5f5' }}>
            {/* Sidebar */}
            <nav className="bg-light border-end p-3" style={{ width: showMenu ? '240px' : '0', transition: 'width 0.3s', overflow: 'hidden' }}>
                <h5 className="text-primary fw-bold mb-4">Dashboard</h5>
                <ul className="list-unstyled">
                    <li className="mb-3"><a href="#" className="text-dark text-decoration-none">📊 Dashboard</a></li>
                    <li className="mb-3"><a href="#" className="text-dark text-decoration-none">✈️ Paquetes</a></li>
                    <li className="mb-3"><a href="#" className="text-dark text-decoration-none">👥 Clientes</a></li>
                    <li className="mb-3"><a href="#" className="text-dark text-decoration-none">⚙️ Configuración</a></li>
                </ul>
            </nav>

            {/* Main Content */}
            <div className="flex-grow-1 p-4" style={{ width: '100%' }}>
                {/* Top Bar */}
                <div className="bg-white p-3 rounded mb-4 d-flex justify-content-between align-items-center">
                    <h2 className="mb-0">Dashboard Costa Rica Trips</h2>
                    <button 
                        className="btn btn-outline-secondary btn-sm"
                        onClick={() => setShowMenu(!showMenu)}
                    >
                        ☰ Menu
                    </button>
                </div>

                {/* Stats Row */}
                <div className="row mb-4">
                    <div className="col-md-3">
                        <div className="card text-center">
                            <div className="card-body">
                                <h6 className="card-title text-muted">Ventas Totales</h6>
                                <h3 className="text-success">$25,500</h3>
                                <small className="text-success">↑ 12% vs mes anterior</small>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-3">
                        <div className="card text-center">
                            <div className="card-body">
                                <h6 className="card-title text-muted">Tours Activos</h6>
                                <h3 className="text-primary">24</h3>
                                <small className="text-primary">5 nuevos esta semana</small>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-3">
                        <div className="card text-center">
                            <div className="card-body">
                                <h6 className="card-title text-muted">Reservas</h6>
                                <h3 className="text-warning">156</h3>
                                <small className="text-warning">23 pendientes</small>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-3">
                        <div className="card text-center">
                            <div className="card-body">
                                <h6 className="card-title text-muted">Clientes</h6>
                                <h3 className="text-info">487</h3>
                                <small className="text-info">+32 este mes</small>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Tours Table */}
                <div className="card mb-4">
                    <div className="card-header bg-light">
                        <h5 className="mb-0">Paquetes Turísticos</h5>
                    </div>
                    <div className="card-body">
                        <table className="table table-hover">
                            <thead className="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Reservas</th>
                                </tr>
                            </thead>
                            <tbody>
                                {tourPackages.map((tour) => (
                                    <tr key={tour.id}>
                                        <td>{tour.nombre}</td>
                                        <td className="fw-bold text-success">{tour.precio}</td>
                                        <td>
                                            <span className={`badge ${tour.estado === 'Activo' ? 'bg-success' : 'bg-warning'}`}>
                                                {tour.estado}
                                            </span>
                                        </td>
                                        <td>{tour.reservas}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Chart Section */}
                <div className="card">
                    <div className="card-header bg-light">
                        <h5 className="mb-0">Ventas por Mes</h5>
                    </div>
                    <div className="card-body">
                        <div style={{ height: '300px', display: 'flex', alignItems: 'flex-end', justifyContent: 'space-around', paddingBottom: '20px', borderBottom: '1px solid #ddd' }}>
                            {salesData.map((data, idx) => (
                                <div key={idx} style={{ textAlign: 'center' }}>
                                    <div style={{
                                        width: '40px',
                                        height: `${(data.ventas / 60) * 2}px`,
                                        backgroundColor: '#0d6efd',
                                        margin: '0 auto',
                                        borderRadius: '4px 4px 0 0'
                                    }}></div>
                                    <small className="mt-2 d-block">{data.mes}</small>
                                    <small className="text-muted">${data.ventas}</small>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
