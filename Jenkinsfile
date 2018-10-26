pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'cd /srv/http/worldlex_jenkins && bin/behat --config app/config/behat.yml --suite=app'
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
