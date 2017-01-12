<?php

namespace derekisbusy\contact\models;

use dektrium\user\models\User;
use derekisbusy\contact\models\base\ContactReason;
use derekisbusy\contact\models\Contact;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * common\models\ContactSearch represents the model behind the search form about `common\models\Contact`.
 */
 class ContactSearch extends Contact
{
     public $assignedTo;
     public $reason;
     
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'assignedTo', 'reason', 'name', 'email', 'phone', 'body', 'url', 'referrer'], 'safe'],
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
        $query = Contact::find();

        $query->joinWith(['reason','assignedTo']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['reason'] = [
            'asc' => [ContactReason::tableName().'.reason' => SORT_ASC],
            'desc' => [ContactReason::tableName().'.reason' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['assignedTo'] = [
            'asc' => [User::tableName().'.username' => SORT_ASC],
            'desc' => [User::tableName().'.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'assigned_to' => $this->assigned_to,
            'contact_reason_id' => $this->contact_reason_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'referrer', $this->referrer])
            ->andFilterWhere(['like', User::tableName().'.username', $this->assignedTo])
            ->andFilterWhere(['like', ContactReason::tableName().'.reason', $this->reason]);

        return $dataProvider;
    }
}
