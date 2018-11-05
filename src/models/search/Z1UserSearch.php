<?php

namespace myzero1\layui\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use myzero1\layui\models\Z1User;

/**
 * Z1UserSearch represents the model behind the search form of `backend\models\Z1User`.
 */
class Z1UserSearch extends Z1User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Z1User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query and sql applied
     *
     * @param array $params
     *
     * @return SqlDataProvider
     */
    public function sqlSearch($params)
    {
        $this->load($params);

        $where =[
           'id' => sprintf('id = "%s"',$this->id),
           'status' => sprintf('status = "%s"',$this->status),
           'created_at' => sprintf('created_at = "%s"',$this->created_at),
           'updated_at' => sprintf('updated_at = "%s"',$this->updated_at),
           'username' => sprintf('username like "%s%%"',$this->username),
           'auth_key' => sprintf('auth_key like "%s%%"',$this->auth_key),
           'password_hash' => sprintf('password_hash like "%s%%"',$this->password_hash),
           'password_reset_token' => sprintf('password_reset_token like "%s%%"',$this->password_reset_token),
           'email' => sprintf('email like "%s%%"',$this->email),
        ];

        $filtedParams = array_filter($this->attributes,
            function($val){return $val!='';});

        $FiltedWhere = ['1=1'];
        foreach ($filtedParams as $key => $value) {
            $FiltedWhere[] = $where[$key];
        }

        $querySql = sprintf('
            SELECT
                %s
            FROM
                %s
            WHERE
                %s
            ', '*', $this->tableName(), implode(' AND ', $FiltedWhere));

        $countSql = sprintf('
            SELECT
                %s
            FROM
                %s
            WHERE
                %s
            ', 'count(1)', $this->tableName(), implode(' AND ', $FiltedWhere));

        $sqlDataProvider = new SqlDataProvider([
            'sql' => $querySql,
            // 'params' => [':sex' => 1],
            'totalCount' => Yii::$app->db->createCommand($countSql)->queryScalar(),
            //'sort' =>false,//如果为假则删除排序
            'key' => 'id',
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
                'attributes' => array_keys($this->attributes),
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $sqlDataProvider;
    }
}
