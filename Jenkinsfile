node {
  stage 'Checkout'
  checkout scm

  stage 'Build'
  if (env.BRANCH_NAME == 'master') {
    def version = sh(script: './version.sh', returnStdout: true).trim()
    withCredentials([
      usernamePassword(credentialsId: '31a94cb8-2f21-4e58-a9e5-bc4aa3ee72a4' usernameVariable: 'GIT_USERNAME', passwordVariable: 'GIT_PASSWORD')
    ]) {

    }
    echo "Current version: ${version}"
    sh './build.sh'
    sh 'ls ./build'
    // sh "git remote set-url origin git@github.com:divvit/plugin-prestashop.git"
    // sh "git config user.email andrei@divvit.com"
    // sh "git config user.name andrei"
    sh "git tag -d ${version}"
    sh "git tag ${version} -m 'Version ${version}'"
    sh "git push https://${GIT_USERNAME}:${GIT_PASSWORD}@github.com/divvit/plugin-prestashop.git --tags"
  }
}
