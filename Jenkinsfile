pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'uname -r'
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
