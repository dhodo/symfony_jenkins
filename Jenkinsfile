pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'cd /srv/http/symfony_jenkins && behat'
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
