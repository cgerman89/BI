<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionTablesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dashboard permissions
        Permission::create([
            'name' => 'Navegar Dashboard',
            'slug' => 'dashboard.index',
            'description' => 'permite acceder a vista dahsboard'
        ]);

        Permission::create([
            'name' => 'Crear Dashboard',
            'slug' => 'dashboard.store',
            'description' => 'permite crear dasboards'
        ]);

        Permission::create([
            'name' => 'Obtiener registro Dashboard',
            'slug' => 'dashboard.allDashboard',
            'description' => 'permite listar dashboards previamente registrados'
        ]);

        Permission::create([
            'name' => 'Editar dashboard',
            'slug' => 'dashboard.edit',
            'description' => 'permite editar datos de dashboard'
        ]);

        Permission::create([
            'name' => 'Actualizar dashboard',
            'slug' => 'dashboard.update',
            'description' => 'permiter guardar cambios al registro de dashboard'
        ]);

        Permission::create([
            'name' => 'Eliminar dashboard',
            'slug' => 'dashboard.delete',
            'description' => 'elimina registro de dashboard'
        ]);

        Permission::create([
            'name' => 'Navegar listas de dashboard',
            'slug' => 'dashboard.list.index',
            'description' => 'acceso a vista que lista dashboards'
        ]);

        Permission::create([
            'name' => 'listar graficos dashboard',
            'slug' => 'dashboard.list.getGraphic',
            'description' => 'muestra los graficos asociados a cada dashboard'
        ]);

        //connections dbms permissions

        Permission::create([
            'name' => 'Navegar en Conexiones',
            'slug' => 'Connections.index',
            'description' => 'acceso a vista Conexiones'
        ]);

        Permission::create([
            'name' => 'Crear Conexion',
            'slug' => 'Connections.store',
            'description' => 'permite crear nuevo registro de conexion a DBMS'
        ]);

        Permission::create([
            'name' => 'Editar Conexion',
            'slug' => 'Connections.edit',
            'description' => 'permite editar registro conexion'
        ]);

        Permission::create([
            'name' => 'Actualizar Conexion',
            'slug' => 'Connections.update',
            'description' => 'permite guardar cambios al registro conexion'
        ]);

        Permission::create([
            'name' => 'Eliminar Conexion',
            'slug' => 'Connections.destroy',
            'description' => 'permite eliminar registro de conexion'
        ]);

        Permission::create([
            'name' => 'Listar Registros de Conexiones',
            'slug' => 'Connections.get_data',
            'description' => 'permite cargar todos los registros de conexiones previamente almacenadas'
        ]);
        // ETL operation Extract permissions
        Permission::create([
            'name' => 'Navegar ETL-Extracion DataBase',
            'slug' => 'etl.index',
            'description' => 'accede a vista Extracion ETL DataBase'
        ]);

        Permission::create([
            'name' => 'Navegar Colecciones ETL',
            'slug' => 'etl.collection.index',
            'description' => 'accede a vista que muestra registros de Colecciones ETL creadas'
        ]);

        Permission::create([
            'name' => 'Navegar ETL-Transformacion',
            'slug' => 'trnf.index',
            'description' => 'accede a vista ETL-Transformaciones'
        ]);

        Permission::create([
            'name' => 'Navegar ETL-Carga(LOAD)',
            'slug' => 'load.index',
            'description' => 'accede a vista ETL-Carga(LOAD) que permite ver los datos cargados al final del proceso etl'
        ]);

        //etl file permissions
        Permission::create([
            'name' => 'Navegar ETL-Extracion File',
            'slug' => 'etl.file.index',
            'description' => 'accede a vista Extracion ETL File'
        ]);

        // graficos permissions
        Permission::create([
            'name' => 'Navegar Graficos',
            'slug' => 'graphic.index',
            'description' => 'permite acceder a vista de graficos'
        ]);

        Permission::create([
            'name' => 'Guardar Grafico',
            'slug' => 'graphic.store',
            'description' => 'permite guardar el grafico generado'
        ]);

        Permission::create([
            'name' => 'Navegar Lista Graficos',
            'slug' => 'graphic.getList.index',
            'description' => 'permite acceder a vista que muestra todos los registos de graficos almacenados'
        ]);
        // permisos permissions
        Permission::create([
            'name' => 'Navegar Permisos',
            'slug' => 'permission.index',
            'description' => 'permite acceder a vista de permisos'
        ]);

        Permission::create([
            'name' => 'Crear Permiso',
            'slug' => 'permission.store',
            'description' => 'permite crear un nuevo registro de permisos'
        ]);

        Permission::create([
            'name' => 'Editar Permisos',
            'slug' => 'permission.edit',
            'description' => 'permiter editar registro de permiso'
        ]);

        Permission::create([
            'name' => 'Actualizar Permisos',
            'slug' => 'permission.update',
            'description' => 'permite guardar cambios al registro de permisos'
        ]);

        Permission::create([
            'name' => 'Eliminar Permiso',
            'slug' => 'permission.destroy',
            'description' => 'permite eliminar el registro de permisos'
        ]);

        Permission::create([
            'name' => 'Listar registros Permisos',
            'slug' => 'permission.getAll',
            'description' => 'permite listar los registros de permisos perviamente guardados'
        ]);

        //roles permissions

        Permission::create([
            'name' => 'Navegar Roles',
            'slug' => 'roles.index',
            'description' => 'permite acceso a vista de roles'
        ]);

        Permission::create([
            'name' => 'Crear Roles',
            'slug' => 'roles.store',
            'description' => 'permite crear registros de roles'
        ]);

        Permission::create([
            'name' => 'Editar Roles',
            'slug' => 'roles.edit',
            'description' => 'permite editar registro de roles'
        ]);

        Permission::create([
            'name' => 'Actualizar Roles',
            'slug' => 'roles.update',
            'description' => 'permite actualizar registro de Roles'
        ]);

        Permission::create([
            'name' => 'Listar Registros Roles',
            'slug' => 'roles.getAllPermission',
            'description' => 'permite lostar los registros de roles previamente registrados'
        ]);

        Permission::create([
            'name' => 'Eliminar Roles',
            'slug' => 'roles.destroy',
            'description' => 'permite eliminar registro de roles'
        ]);

        Permission::create([
            'name' => 'Listar Permisos Roles',
            'slug' => 'roles.getPermissions',
            'description' => 'permite listar los permisos de roles previamente asignados'
        ]);

        Permission::create([
            'name' => 'Listar Registros Roles',
            'slug' => 'roles.getAll',
            'description' => 'permite listar los registros de roles almacenados'
        ]);

        // users roles permissions

        Permission::create([
            'name' => 'Navegar Roles Usuarios',
            'slug' => 'permissions.users.index',
            'description' => 'permite acceder a la vista de roles usuarios'
        ]);

        Permission::create([
            'name' => 'Asignar Roles Usuarios',
            'slug' => 'permissions.users.store',
            'description' => 'permite asignar roles a un usuario registrados'
        ]);

        Permission::create([
            'name' => 'Listar Usuarios',
            'slug' => 'permissions.users.getAllUsers',
            'description' => 'permite listar registros de usuarios para administrar roles'
        ]);

        Permission::create([
            'name' => 'Listar Roles Usuarios',
            'slug' => 'permissions.users.getRoles',
            'description' => 'permite listar roles para asignar a usuarios'
        ]);

        Permission::create([
            'name' => 'Editar Usuario Roles',
            'slug' => 'permissions.users.getUser',
            'description' => 'permite editar roles sobre usuarios'
        ]);

        Permission::create([
            'name' => 'Lista Roles Por Usuario',
            'slug' => 'permissions.users.showRoles',
            'description' => 'permite listar los roles asignados a un usuario'
        ]);

        Permission::create([
            'name' => 'Eliminar Roles Usuario',
            'slug' => 'permissions.users.destroy',
            'description' => 'permite eliminar todos los roles asignados a usuarios'
        ]);

        Permission::create([
            'name' => 'Eliminar Rol Usuario',
            'slug' => 'permissions.users.destroyRole',
            'description' => 'permite eliminar un rol en especifico a un usuario'
        ]);

        //user permissions

        Permission::create([
            'name' => 'Navegar Vista Usuarios',
            'slug' => 'users.index',
            'description' => 'permite acceder a la vista de administracion de usuarios'
        ]);

        Permission::create([
            'name' => 'Editar Usuario',
            'slug' => 'users.edit',
            'description' => 'permite editar registro de usuarios'
        ]);

        Permission::create([
            'name' => 'Eliminar Usuario',
            'slug' => 'users.destroy',
            'description' => 'permite eliminar registro de usuario'
        ]);

        Permission::create([
            'name' => 'Crear Usaurio',
            'slug' => 'users.store',
            'description' => 'permite crear registro de nuevo usuario'
        ]);

        Permission::create([
            'name' => 'Listar Usuarios',
            'slug' => 'users.getAll',
            'description' => 'permite listar todos los usuarios registrados'
        ]);

        Permission::create([
            'name' => 'Actualizar Usuarios',
            'slug' => 'users.update',
            'description' => 'permite guardar los cambios a registro de usuarios'
        ]);

        Permission::create([
            'name' => 'Reset Password Usuarios',
            'slug' => 'users.resetPwd',
            'description' => 'permite resetear los passwords de usuarios'
        ]);

       /** Permission::create([
            'name' => '',
            'slug' => '',
            'description' => ''
        ]); */


    }
}
