pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'cd /srv/http/symfony_jenkins && bin/behat --config app/config/behat.yml --suite=app'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing....'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
