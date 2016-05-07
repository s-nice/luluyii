<?php
namespace modules\user\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\user\models\UserInfo;

class UserInfoSearch extends UserInfo
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'sex', 'qq'], 'integer'],
            [['birthday', 'location'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = UserInfo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'qq' => $this->qq,
        ]);
        $query->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'location', $this->location]);
        return $dataProvider;
    }
}