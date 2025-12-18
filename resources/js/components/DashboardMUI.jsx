import React, { useState } from 'react';
import {
    Box,
    Drawer,
    AppBar,
    Toolbar,
    Typography,
    List,
    ListItem,
    ListItemButton,
    ListItemIcon,
    ListItemText,
    Card,
    CardContent,
    Grid,
    Paper,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Avatar,
    Chip,
    IconButton
} from '@mui/material';
import {
    Dashboard as DashboardIcon,
    TravelExplore,
    People,
    Settings,
    Menu as MenuIcon,
    AttachMoney,
    TrendingUp,
    NotificationsNone
} from '@mui/icons-material';
import { LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

const drawerWidth = 240;

// Datos de ejemplo
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
    const [mobileOpen, setMobileOpen] = useState(false);

    const handleDrawerToggle = () => {
        setMobileOpen(!mobileOpen);
    };

    const drawer = (
        <div>
            <Toolbar>
                <Typography variant="h6" noWrap component="div" sx={{ color: '#1976d2', fontWeight: 'bold' }}>
                    MUI Dashboard
                </Typography>
            </Toolbar>
            <List>
                {[
                    { text: 'Dashboard', icon: <DashboardIcon /> },
                    { text: 'Paquetes', icon: <TravelExplore /> },
                    { text: 'Clientes', icon: <People /> },
                    { text: 'Configuración', icon: <Settings /> },
                ].map((item) => (
                    <ListItem key={item.text} disablePadding>
                        <ListItemButton>
                            <ListItemIcon sx={{ color: '#1976d2' }}>
                                {item.icon}
                            </ListItemIcon>
                            <ListItemText primary={item.text} />
                        </ListItemButton>
                    </ListItem>
                ))}
            </List>
        </div>
    );

    return (
        <Box sx={{ display: 'flex', backgroundColor: '#f5f5f5', minHeight: '100vh' }}>
            {/* AppBar */}
            <AppBar
                position="fixed"
                sx={{ zIndex: (theme) => theme.zIndex.drawer + 1, backgroundColor: '#fff', color: '#000' }}
            >
                <Toolbar>
                    <IconButton
                        color="inherit"
                        edge="start"
                        onClick={handleDrawerToggle}
                        sx={{ mr: 2, display: { sm: 'none' } }}
                    >
                        <MenuIcon />
                    </IconButton>
                    <Typography variant="h6" noWrap component="div" sx={{ flexGrow: 1 }}>
                        Costa Rica Trip Packages
                    </Typography>
                    <IconButton color="inherit">
                        <NotificationsNone />
                    </IconButton>
                    <Avatar sx={{ ml: 2, bgcolor: '#1976d2' }}>A</Avatar>
                </Toolbar>
            </AppBar>

            {/* Drawer */}
            <Box
                component="nav"
                sx={{ width: { sm: drawerWidth }, flexShrink: { sm: 0 } }}
            >
                <Drawer
                    variant="temporary"
                    open={mobileOpen}
                    onClose={handleDrawerToggle}
                    ModalProps={{ keepMounted: true }}
                    sx={{
                        display: { xs: 'block', sm: 'none' },
                        '& .MuiDrawer-paper': { boxSizing: 'border-box', width: drawerWidth },
                    }}
                >
                    {drawer}
                </Drawer>
                <Drawer
                    variant="permanent"
                    sx={{
                        display: { xs: 'none', sm: 'block' },
                        '& .MuiDrawer-paper': { boxSizing: 'border-box', width: drawerWidth },
                    }}
                    open
                >
                    {drawer}
                </Drawer>
            </Box>

            {/* Main Content */}
            <Box
                component="main"
                sx={{ 
                    flexGrow: 1, 
                    p: { xs: 2, sm: 3 }, 
                    width: { sm: `calc(100% - ${drawerWidth}px)` },
                    backgroundColor: '#f5f5f5',
                    minHeight: '100vh'
                }}
            >
                <Toolbar />

                {/* Stats Cards */}
                <Grid container spacing={{ xs: 2, md: 3 }} sx={{ mb: 3 }}>
                    {[
                        { title: 'Ventas Totales', value: '$24,500', icon: <AttachMoney />, color: '#4caf50' },
                        { title: 'Paquetes Activos', value: '12', icon: <TravelExplore />, color: '#2196f3' },
                        { title: 'Clientes', value: '248', icon: <People />, color: '#ff9800' },
                        { title: 'Crecimiento', value: '+23%', icon: <TrendingUp />, color: '#9c27b0' },
                    ].map((stat, index) => (
                        <Grid item xs={12} sm={6} md={3} key={index}>
                            <Card>
                                <CardContent>
                                    <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                        <div>
                                            <Typography color="textSecondary" gutterBottom variant="body2">
                                                {stat.title}
                                            </Typography>
                                            <Typography variant="h5" component="div" sx={{ fontWeight: 'bold' }}>
                                                {stat.value}
                                            </Typography>
                                        </div>
                                        <Avatar sx={{ bgcolor: stat.color, width: 56, height: 56 }}>
                                            {stat.icon}
                                        </Avatar>
                                    </Box>
                                </CardContent>
                            </Card>
                        </Grid>
                    ))}
                </Grid>

                {/* Chart */}
                <Paper sx={{ p: { xs: 2, sm: 3 }, mb: 3 }}>
                    <Typography variant="h6" gutterBottom>
                        Ventas Mensuales
                    </Typography>
                    <ResponsiveContainer width="100%" height={300}>
                        <LineChart data={salesData}>
                            <CartesianGrid strokeDasharray="3 3" />
                            <XAxis dataKey="mes" />
                            <YAxis />
                            <Tooltip />
                            <Legend />
                            <Line type="monotone" dataKey="ventas" stroke="#1976d2" strokeWidth={2} />
                        </LineChart>
                    </ResponsiveContainer>
                </Paper>

                {/* Table */}
                <Paper sx={{ p: { xs: 2, sm: 3 } }}>
                    <Typography variant="h6" gutterBottom>
                        Paquetes Turísticos
                    </Typography>
                    <TableContainer sx={{ overflowX: 'auto' }}>
                        <Table>
                            <TableHead>
                                <TableRow>
                                    <TableCell><strong>ID</strong></TableCell>
                                    <TableCell><strong>Nombre</strong></TableCell>
                                    <TableCell><strong>Precio</strong></TableCell>
                                    <TableCell><strong>Estado</strong></TableCell>
                                    <TableCell><strong>Reservas</strong></TableCell>
                                </TableRow>
                            </TableHead>
                            <TableBody>
                                {tourPackages.map((pkg) => (
                                    <TableRow key={pkg.id} hover>
                                        <TableCell>{pkg.id}</TableCell>
                                        <TableCell>{pkg.nombre}</TableCell>
                                        <TableCell>{pkg.precio}</TableCell>
                                        <TableCell>
                                            <Chip 
                                                label={pkg.estado} 
                                                color={pkg.estado === 'Activo' ? 'success' : 'default'}
                                                size="small"
                                            />
                                        </TableCell>
                                        <TableCell>{pkg.reservas}</TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    </TableContainer>
                </Paper>
            </Box>
        </Box>
    );
}
