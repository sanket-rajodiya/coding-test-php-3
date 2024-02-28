<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ArticleLikes Controller
 *
 * @property \App\Model\Table\ArticleLikesTable $ArticleLikes
 * @method \App\Model\Entity\ArticleLike[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticleLikesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Articles'],
        ];
        $articleLikes = $this->paginate($this->ArticleLikes);

        $this->set(compact('articleLikes'));
    }

    /**
     * View method
     *
     * @param string|null $id Article Like id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $articleLike = $this->ArticleLikes->get($id, [
            'contain' => ['Users', 'Articles'],
        ]);

        $this->set(compact('articleLike'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $articleLike = $this->ArticleLikes->newEmptyEntity();
        if ($this->request->is('post')) {
            $articleLike = $this->ArticleLikes->patchEntity($articleLike, $this->request->getData());
            if ($this->ArticleLikes->save($articleLike)) {
                $this->Flash->success(__('The article like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article like could not be saved. Please, try again.'));
        }
        $users = $this->ArticleLikes->Users->find('list', ['limit' => 200])->all();
        $articles = $this->ArticleLikes->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('articleLike', 'users', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article Like id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $articleLike = $this->ArticleLikes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleLike = $this->ArticleLikes->patchEntity($articleLike, $this->request->getData());
            if ($this->ArticleLikes->save($articleLike)) {
                $this->Flash->success(__('The article like has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article like could not be saved. Please, try again.'));
        }
        $users = $this->ArticleLikes->Users->find('list', ['limit' => 200])->all();
        $articles = $this->ArticleLikes->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('articleLike', 'users', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article Like id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $articleLike = $this->ArticleLikes->get($id);
        if ($this->ArticleLikes->delete($articleLike)) {
            $this->Flash->success(__('The article like has been deleted.'));
        } else {
            $this->Flash->error(__('The article like could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function like(){
        $this->request->allowMethod('post');
        $user_request = $this->request->getData();
        $article_id = $user_request['article_id'];
        $userID = $this->Authentication->getIdentityData('id');
        $created_at = $user_request['created_at'];
        $updated_at = $user_request['updated_at'];

        $likeExists = $this->ArticleLikes->find()
            ->where([
                'user_id' => $userID,
                'article_id' => $article_id
            ])
            ->first();

        // Check if already Liked the Article
        if ($likeExists) {
            $res = [
                'message' => 'Already liked',
                'status' => 'error',
            ];
            $this->set(compact('res'));
            $this->setResponse($this->getResponse()->withStatus(400));
            $this->viewBuilder()->setOption('serialize', ['res']);
            return;
        }

        $userlikeObj = $this->ArticleLikes->newEmptyEntity();
        $userlikeObj = $this->ArticleLikes->patchEntity($userlikeObj, [
            'user_id' => $userID,
            'article_id' => $article_id,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ]);

        // Store Article Like
        if ($this->ArticleLikes->save($userlikeObj)) {
            $result = [
                'message' => 'Liked!',
                'status' => 'success',
            ];

            $this->set(compact('result'));
            $this->viewBuilder()->setOption('serialize', ['result']);
        } else {
            $result = [
                'message' => 'Like is not saved',
                'status' => 'error',
                'errors' => $userlikeObj->getErrors(),
            ];

            $this->setResponse($this->getResponse()->withStatus(400));
            $this->set(compact('result'));
            $this->viewBuilder()->setOption('serialize', ['result']);
        }
    }
}
