<?php
class Access extends CFilter {

    protected function preFilter( $filterChain ) {

        foreach (Yii::app()->log->routes as $route) {
            $route->enabled=false;
        }

        $ac = Yii::app()->request->getParam('access_token');
        $response = array(
            'error' => false,
            'message' => null,
            'code' => 0
        );

        try {

            // Check request
            if (empty($ac))
                throw new Exception('Envie um token');

            // Check access
            $access = AccessToken::model()->findByPk($ac);
            if (empty($access))
                throw new Exception('Token inválido', 1);

            // Check user
            if (!isset($access->user) || empty($access->user))
                throw new Exception('Usuário inválido', 2);

            // Check Status
            if ($access->status != 1)
                throw new Exception('Token expirado', 3);

        } catch (Exception $e) {
            $response['error'] = true;
            $response['message'] = $e->getMessage();
            $response['code'] = $e->getCode();
            echo json_encode($response);
            exit;
        }
        
        return true;
    }
}
?>