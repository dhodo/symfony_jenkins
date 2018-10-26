pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'cd /srv/http/safarigay && ls'
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
