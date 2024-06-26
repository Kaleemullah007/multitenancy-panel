<?php


return [
    'btn-save' => 'Ahorrar',
    'btn-cancel' => 'Cancelar',
    'btn-reset' => 'Reiniciar',
    'btn_permanently_deleted' => 'Eliminada permanentemente',
    'btn-manage-permission' => 'Administrar permisos',
    'btn-deleted' => 'Eliminada',
    'btn_restored' => 'Restaurar',
    'btn_role_permission' => 'Actualizar permisos y roles',
    'btn-edit' => 'Actualizar',
    'edit' => 'Editar',
    'create' => 'Crear',
    'create_user' => 'Crear usuario',
    'edit_user' => 'editar usuario',
    'users' => 'Usuarias',
    'tenants' => 'Inquilinas',
    'renew' => 'Renovar',
    'btn-update-profile' => 'Actualización del perfil',

    'create_user' => 'Agregar inquilina',
    'description' => 'Crear nueva inquilina del sistema',

    'btn-export-csv' => 'Exportar usuarios csv',
    'btn-export-xlsx' => 'Exportar usuarias xlsx',
    'btn-import-cvs' => 'Importar usuarios csv',
    'btn-export-pdf' => 'Exportar usuarias en PDF',



    'table' => [
        '#' => 'No Señor',
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'role' => 'Role',
        'domains' => 'dominios',
        'action' => 'Acción',
        'plan' => 'Plan',
        'date' => 'fechas',
        'avatar' => 'Imagen',
    ],
    'form' => [
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'roles' => 'Roles',
        'password' => 'Contraseña',
        'password_confirm' => 'confirmar Contraseña',
        'permissions' => 'permisos',
        'domain' => 'Dominio',
        'profile_photo' => 'Foto de perfil',
        'status' => 'Estado',
        'plan' => 'Plan',
        'upload_description'=>'Arrastra y suelta un archivo para cargar',
         'file'=>'Drag and drop a file to upload Excel',
         'file_upload_description'=>'Drag and drop a file to upload xlsx , csv',
         'import_heading'=>'Import XLSX file',
         'import_desc'=>'Upload files of tenants xlsx or csv file',
         'import_save'=>'Import',
         'export_btn'=>'Export',
    ],
    'message' => [
        'save-message' => 'Usuario creada con éxito',
        'update-message' => 'Usuario actualizada con éxito',
        'delete-message' => 'Usuario eliminada exitosamente',
        'restore-message' => 'Usuario restaurada con éxito',
        'permanently-delete-message' => 'Eliminación de usuario permanentemente exitosa',
        'renew-message' => 'El usuario ha renovado con éxito',

        'error_name' => 'El nombre es campo obligatorio',
        'error_roles' => 'El rol es un campo obligatorio',
        'error_email' => 'El correo electrónico es un campo obligatorio',
        'error_domain' => 'El dominio es un campo obligatorio',
        'error_password' => 'La contraseña es un campo obligatorio',
        'error_profile_photo' => 'La foto de perfil es un campo obligatorio; el tipo de archivo es jpeg,jpg,png',
        'error_domain_already' => 'El subdominio ya existe',
        'error_email_unique' => 'El correo electrónico ya está en uso, prueba con otro.',

    ]

];
