node {
  stage 'Checkout'
  checkout scm

  stage 'Build'
  if (env.BRANCH_NAME == 'master') {
    def version = sh(script: './version.sh', returnStdout: true)
    echo "Current version: ${version}"
    sh './build.sh'
    sh 'ls ./build'
    sh "git remote set-url origin git@github.com:divvit/plugin-prestashop.git"
    sh "git config user.email andrei@divvit.com"
    sh "git config user.name andrei"
    // sh "git tag -d ${version}"
    sh "git tag ${version} -m 'Version ${version}'"
    sh "git push --tags"
  }
}
