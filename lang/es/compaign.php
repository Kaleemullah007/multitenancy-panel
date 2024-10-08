<?php


return [
    'btn-save' => 'Ahorrar',
    'btn-cancel' => 'Cancelar',
    'btn-reset' => 'Reiniciar',
    'btn_permanently_deleted' => 'Eliminada permanentemente',
    'btn-delete' => 'borrar',
    'btn_restored' => 'Restaurar',
    'btn-edit' => 'Actualizar',
    'edit' => 'Editar',
    'create' => 'Crear',
    'create_compaign' => 'Crear campaña',
    'edit_compaign' => 'Editar campaña',
    'campaigns' => 'Campañas',

    'btn-export-csv' => 'Exportar csv',
    'btn-export-xlsx' => 'Exportar xlsx',
    'btn-import-cvs' => 'Importar csv',
    'btn-export-pdf' => 'Exportar en PDF',


    'table' => [
        '#' => 'No Señor',
        'name' => 'Nombre',
        'type' => 'Tipo de plantilla',
        'template_type' => 'Seleccionar plantilla',
        'status' => 'Estado',
        'user_type' => 'Tipo de usuario',
        'published_at' => 'Publicado en',
        'action' => 'Acción'
    ],
    'form' => [
        '#' => 'No Señor',
        'name' => 'Nombre',
        'type' => 'Tipo de plantilla',
        'template_type' => 'Seleccionar plantilla',
        'status' => 'Estado',
        'user_type' => 'Tipo de usuario',
        'published_at' => 'Publicado en',
        'action' => 'Acción',
        'btn' => 'Action',
        'email' => 'correo electrónico',
        'sms' => 'SMS',
    ],
    'message' => [
        'save-message' => 'Campaña creada con éxito',
        'update-message' => 'Campaña actualizada con éxito',
        'delete-message' => 'Campaña eliminada exitosamente',
        'no-edit' => 'No puedes editar una campaña después de una hora.',

        'restore-message' => 'Campaña restaurada exitosamente',
        'permanently-delete-message' => 'Eliminación de campaña permanentemente exitosa',

        'error_name' => 'El campo Nombre es obligatorio',
        'error_name_unique' => 'El nombre de la campaña debe ser único.',

        'error_type' => 'El campo tipo plantilla es obligatorio',
        'error_type_unique' => 'El tipo de plantilla de campaña debe ser único',

        'error_user_type' => 'El campo Seleccionar usuario es obligatorio',
        'error_template_type' => 'El campo Tipo de plantilla es obligatorio',
        'error_status' => 'El campo Estado es obligatorio',
        'error_user_id' => 'El campo ID de usuario es obligatorio',
        'error_published_at' => 'El campo Publicado en es obligatorio',
        'error_schedule_message' => ', y no hay mensajes programados para los usuarios',
        'success_schedule_message' => ', y mensajes programados para los usuarios'



    ]

];
